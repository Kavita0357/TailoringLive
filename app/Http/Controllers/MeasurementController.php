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
            
            $business_id = request()->session()->get('user.business_id');
            if (auth()->user()->hasRole('Tailor Master#' . $business_id)) {
                abort(403, 'Unauthorized action.');
            }
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
    /* public function store(Request $request)
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
    } */

        
public function store(Request $request)
{
    $request->validate([
        'measurement_name' => 'required|string|max:255',
        'serial_no' => 'nullable|integer',
        'cloths' => 'nullable|array',
        'cloths.*' => 'integer',
        'sub_measurements' => 'nullable|array',
        'sub_measurements.*.name' => 'required|string|max:255',
        'sub_measurements.*.serial_no' => 'nullable|integer',
    ]);

    $business_id = $request->session()->get('user.business_id');
    $created_by = $request->session()->get('user.id');

    try {
        DB::beginTransaction();

        $measurement = Measurement::create([
            'measurement_name' => $request->measurement_name,
            'serial_no' => $request->serial_no,
            'business_id' => $business_id,
            'created_by' => $created_by,
        ]);

        // Link selected cloths.
        $clothIds = Cloth::where('business_id', $business_id)
            ->whereIn('id', $request->input('cloths', []))
            ->pluck('id')
            ->all();

        $measurement->cloths()->sync($clothIds);

        // Create sub-measurements directly.
        $syncData = [];

        foreach ($request->input('sub_measurements', []) as $subData) {
            $name = trim($subData['name'] ?? '');

            if ($name === '') {
                continue;
            }

            $subMeasurement = SubMeasurement::create([
                'sub_measurement_name' => $name,
                'serial_no' => $subData['serial_no'] ?? null,
                'business_id' => $business_id,
                'created_by' => $created_by,
            ]);

            $syncData[$subMeasurement->id] = [
                'serial_no' => $subData['serial_no'] ?? null,
            ];
        }

        $measurement->subMeasurements()->sync($syncData);

        DB::commit();

        return response()->json([
            'success' => true,
            'data' => $measurement,
            'msg' => __('tailoring.measurement_add'),
        ]);
    } catch (\Throwable $e) {
        DB::rollBack();

        Log::error('Measurement Store Error', [
            'message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
        ]);

        return response()->json([
            'success' => false,
            'msg' => __('messages.something_went_wrong'),
        ], 500);
    }
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



    // Update Measurement
public function update(Request $request, $id)
{
    try {
        $request->validate([
            'measurement_name' => 'required|string|max:255',
            'serial_no' => 'nullable|integer',
            'cloths' => 'nullable|array',
            'cloths.*' => 'integer|exists:cloths,id',
            'sub_measurements' => 'nullable|array',
            'sub_measurements.*.id' => 'nullable|integer',
            'sub_measurements.*.name' => 'required|string|max:255',
            'sub_measurements.*.serial_no' => 'required|integer|min:1',
        ]);

        DB::beginTransaction();

        $measurement = Measurement::findOrFail($id);

        // Update the main measurement
        $measurement->update([
            'measurement_name' => $request->measurement_name,
            'serial_no' => $request->serial_no,
        ]);

        // Sync selected cloths
        $measurement->cloths()->sync(
            $request->input('cloths', [])
        );

        $subMeasurementsData = $request->input('sub_measurements', []);
        $syncData = [];

        foreach ($subMeasurementsData as $sub) {
            $subId = $sub['id'] ?? null;
            $subName = trim($sub['name'] ?? '');
            $serialNo = $sub['serial_no'] ?? null;

            if ($subId) {
                // Only allow existing sub-measurements
                // already attached to this measurement.
                $existingSub = $measurement->subMeasurements()
                    ->where('sub_measurements.id', $subId)
                    ->first();

                if (!$existingSub) {
                    throw new \Illuminate\Validation\ValidationException(
                        validator([], [])
                    );
                }

                // Preserve the existing sub-measurement record.
                $syncData[$existingSub->id] = [
                    'serial_no' => $serialNo,
                ];
            } else {
                // Create a new sub-measurement.
                if ($subName === '') {
                    continue;
                }

                $newSub = SubMeasurement::create([
                    'sub_measurement_name' => $subName,
                ]);

                $syncData[$newSub->id] = [
                    'serial_no' => $serialNo,
                ];
            }
        }

        // Attach new records, update serial numbers,
        // and detach removed sub-measurements.
        $measurement->subMeasurements()->sync($syncData);

        DB::commit();

        return [
            'success' => true,
            'msg' => __('tailoring.measurement_update'),
        ];

    } catch (\Throwable $e) {
        DB::rollBack();

        Log::error('Measurement update failed', [
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'message' => $e->getMessage(),
        ]);

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
