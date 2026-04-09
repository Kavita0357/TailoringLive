<?php

namespace App\Http\Controllers;

use App\SubMeasurement;
use App\Utils\ModuleUtil;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;


class SubMeasurementController extends Controller
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

            $sub_measurements = SubMeasurement::where('business_id', $business_id)
                ->select(['sub_measurement_name', 'serial_no', 'id']);

            return Datatables::of($sub_measurements)
                ->addColumn(
                    'action',
                    '<button data-href="{{action(\'App\Http\Controllers\SubMeasurementController@edit\', [$id])}}" class="tw-dw-btn tw-dw-btn-xs tw-dw-btn-outline tw-dw-btn-primary edit_sub_measurement_button"><i class="glyphicon glyphicon-edit"></i> @lang("messages.edit")</button>
                        &nbsp;                        
                    <button data-href="{{action(\'App\Http\Controllers\SubMeasurementController@destroy\', [$id])}}" class="tw-dw-btn tw-dw-btn-outline tw-dw-btn-xs tw-dw-btn-error delete_sub_measurement_button"><i class="glyphicon glyphicon-trash"></i> @lang("messages.delete")</button>'
                )
                ->removeColumn(['id', 'serial_no'])
                ->rawColumns([1])
                ->make(false);
        }

        return view('sub_measurement.index');
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

        return view('sub_measurement.create');
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
                'sub_measurement_name' => 'required|string|max:255',
                'serial_no' => 'nullable|integer',
            ]);

            $business_id = $request->session()->get('user.business_id');
            $input = $request->only(['sub_measurement_name', 'serial_no']);
            $input['business_id'] = $business_id;
            $input['created_by'] = $request->session()->get('user.id');

            $data = SubMeasurement::create($input);

            $output = [
                'success' => true,
                'data' => $data,
                'msg' => __('tailoring.sub_measurement_add'),
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
        $sub_measurement = SubMeasurement::findOrFail($id);
        return view('sub_measurement.edit', compact('sub_measurement'));
    }

    // Update
    public function update(Request $request, $id)
    {
        $request->validate([
            'sub_measurement_name' => 'required|string|max:255',
            'serial_no' => 'nullable|integer',
        ]);

        $sub_measurement = SubMeasurement::findOrFail($id);
        $sub_measurement->update($request->only('sub_measurement_name', 'serial_no'));

        return response()->json(['success' => true, 'msg' => __('tailoring.sub_measurement_update')]);
    }

    // Delete
    public function destroy($id)
    {
        $sub_measurement = SubMeasurement::findOrFail($id);
        // Check if measurement is linked with any cloth
        if ($sub_measurement->measurements()->exists()) {
            return response()->json([
                'success' => false,
                'msg' => __('tailoring.sub_measurement_cannot_delete')
            ]);
        }

        $sub_measurement->delete();

        return response()->json([
            'success' => true,
            'msg' => __('tailoring.sub_measurement_delete')
        ]);
    }
}
