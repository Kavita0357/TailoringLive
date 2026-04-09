<?php

namespace App\Http\Controllers;

use App\Measurement;
use App\Cloth;
use App\SubMeasurement;
use App\Utils\ModuleUtil;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;


class MeasurementController extends Controller
{
    protected $moduleUtil;

    protected $enabled_modules;

    /**
     * Constructor
     *
     * @param  Util  $commonUtil
     * @return void
     */
    public function __construct(
        ModuleUtil $moduleUtil
    ) {
        $this->middleware(function ($request, $next) use ($moduleUtil) {
            $this->moduleUtil = $moduleUtil;
            $this->enabled_modules = session('business.enabled_modules') ?? [];
            return $next($request);
        });
    }


    public function index()
    {
        if (request()->ajax()) {
            $business_id = request()->session()->get('user.business_id');

            $measurements = Measurement::with(['subMeasurements' => function ($query) {
                $query->orderBy('measurement_sub_measurement.serial_no', 'asc');
            }])
                ->where('business_id', $business_id)
                ->orderByRaw('ISNULL(serial_no), serial_no ASC')
                ->select(['id', 'measurement_name', 'serial_no']);

            return Datatables::of($measurements)
                ->addColumn('sub_measurements', function ($row) {
                    return $row->subMeasurements
                        ->sortBy(function ($sub) {
                            return $sub->pivot->serial_no; // sort again just to be safe
                        })
                        ->pluck('sub_measurement_name')
                        ->implode(', ');
                })
                ->addColumn('cloth', function ($row) {
                    return $row->cloths->pluck('cloth_name')->implode(', ');
                })
                ->addColumn('action', function ($row) {
                    $edit_url = action([\App\Http\Controllers\MeasurementController::class, 'edit'], [$row->id]);
                    $delete_url = action([\App\Http\Controllers\MeasurementController::class, 'destroy'], [$row->id]);

                    return '
                    <button data-href="' . $edit_url . '" class="tw-dw-btn tw-dw-btn-xs tw-dw-btn-outline tw-dw-btn-primary edit_measurement_button">
                        <i class="glyphicon glyphicon-edit"></i> ' . __('messages.edit') . '
                    </button>
                    &nbsp;
                    <button data-href="' . $delete_url . '" class="tw-dw-btn tw-dw-btn-outline tw-dw-btn-xs tw-dw-btn-error delete_measurement_button">
                        <i class="glyphicon glyphicon-trash"></i> ' . __('messages.delete') . '
                    </button>';
                })
                ->removeColumn('id')
                ->rawColumns(['action']) // only 'action' needs to be rendered as raw HTML
                ->make(true);
        }
        return view('measurement.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!in_array('tailoring', $this->enabled_modules)) {
            abort(403, 'Unauthorized action.');
        }

        $business_id = request()->session()->get('user.business_id');

        //Check if subscribed or not
        if (!$this->moduleUtil->isSubscribed($business_id)) {
            return $this->moduleUtil->expiredResponse();
        }

        $sub_measurements = SubMeasurement::where('business_id', $business_id)
            ->pluck('sub_measurement_name', 'id');

        $cloths = Cloth::where('business_id', $business_id)
            ->pluck('cloth_name', 'id');

        return view('measurement.create', compact('sub_measurements', 'cloths'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // Store data
    public function store(Request $request)
    {
        try {
            $request->validate([
                'measurement_name' => 'required|string|max:255',
                'serial_no' => 'nullable|integer',
            ]);

            $business_id = $request->session()->get('user.business_id');
            $input = $request->only(['measurement_name', 'serial_no']);
            $input['business_id'] = $business_id;
            $input['created_by'] = $request->session()->get('user.id');

            $measurement = Measurement::create($input);

            $subMeasurements = $request->input('sub_measurements', []);
            $syncData = [];
            foreach ($subMeasurements as $sub) {
                if (isset($sub['id'])) {
                    $syncData[$sub['id']] = ['serial_no' => $sub['serial_no'] ?? null];
                }
            }

            $measurement->subMeasurements()->sync($syncData);
            $measurement->cloths()->sync($request->input('cloths'));

            $output = [
                'success' => true,
                'data' => $measurement,
                'msg' => __('tailoring.measurement_add'),
            ];
        } catch (\Exception $e) {
            DB::rollBack();
            Log::emergency('File:' . $e->getFile() . 'Line:' . $e->getLine() . 'Message:' . $e->getMessage());

            $output = [
                'success' => false,
                'msg' => __('messages.something_went_wrong'),
            ];
        }

        return $output;
    }

    // Edit form
    public function edit($id)
    {
        if (!in_array('tailoring', $this->enabled_modules)) {
            abort(403, 'Unauthorized action.');
        }

        $business_id = request()->session()->get('user.business_id');

        // Subscription check
        if (!$this->moduleUtil->isSubscribed($business_id)) {
            return $this->moduleUtil->expiredResponse();
        }

        // Get the measurement with sub_measurements sorted by pivot serial_no
        $measurement = Measurement::with(['subMeasurements' => function ($query) {
            $query->orderBy('pivot_serial_no');
        }])->where('business_id', $business_id)->findOrFail($id);

        // All available sub_measurements for dropdown
        $sub_measurements = SubMeasurement::where('business_id', $business_id)
            ->pluck('sub_measurement_name', 'id');

       $cloths = Cloth::where('business_id', $business_id)
            ->pluck('cloth_name', 'id');

        // Structured selected sub_measurements with serial_no
        $selected_sub_measurements = [];
        foreach ($measurement->subMeasurements as $sub) {
            $selected_sub_measurements[] = [
                'id' => $sub->id,
                'name' => $sub->sub_measurement_name,
                'serial_no' => $sub->pivot->serial_no,
            ];
        }

        return view('measurement.edit', compact('measurement', 'sub_measurements', 'selected_sub_measurements', 'cloths'));
    }



    // Update
    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            $request->validate([
                'measurement_name' => 'required|string|max:255',
                'serial_no' => 'nullable|integer',
            ]);

            $measurement = Measurement::findOrFail($id);
            $measurement->update([
                'measurement_name' => $request->measurement_name,
                'serial_no' => $request->serial_no,
            ]);

            $sub_measurements_data = $request->input('sub_measurements', []);

            $sync_data = [];
            foreach ($sub_measurements_data as $sub) {
                if (!empty($sub['id'])) {
                    $sync_data[$sub['id']] = ['serial_no' => $sub['serial_no']];
                }
            }

            $measurement->subMeasurements()->sync($sync_data);

            if ($request->has('cloths')) {
                $measurement->cloths()->sync($request->input('cloths'));
            } else {
                $measurement->cloths()->sync([]); // Remove all if none selected
            }

            DB::commit();

            return [
                'success' => true,
                'msg' => __('tailoring.measurement_update'),
            ];
        } catch (\Exception $e) {
            DB::rollBack();
            Log::emergency('File:' . $e->getFile() . 'Line:' . $e->getLine() . 'Message:' . $e->getMessage());

            return [
                'success' => false,
                'msg' => __('messages.something_went_wrong'),
            ];
        }
    }

    // Delete
    public function destroy($id)
    {
        $measurement = Measurement::findOrFail($id);

        // Check if measurement is linked with any cloth
        if ($measurement->cloths()->exists()) {
            return response()->json([
                'success' => false,
                'msg' => __('tailoring.measurement_cannot_delete')
            ]);
        }

        $measurement->delete();

        return response()->json([
            'success' => true,
            'msg' => __('tailoring.measurement_delete')
        ]);
    }
}
