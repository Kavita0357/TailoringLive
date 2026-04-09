<?php

namespace App\Http\Controllers;

use App\BusinessLocation;
use App\Cloth;
use App\ClothCustomization;
use App\Contact;
use App\Design;
use App\Measurement;
use App\Style;
use App\TransactionSellLine;
use App\Utils\BusinessUtil;
use App\Utils\ModuleUtil;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;


class ClothController extends Controller
{
    protected $moduleUtil;
    protected $businessUtil;

    protected $enabled_modules;

    /**
     * Constructor
     *
     * @param  Util  $commonUtil
     * @return void
     */
    public function __construct(
        ModuleUtil $moduleUtil,
        BusinessUtil $businessUtil,
    ) {
        $this->middleware(function ($request, $next) use ($moduleUtil) {
            $this->moduleUtil = $moduleUtil;
            $this->enabled_modules = session('business.enabled_modules') ?? [];
            return $next($request);
        });
        $this->businessUtil = $businessUtil;
    }

    public function index()
    {
        if (request()->ajax()) {
            $business_id = request()->session()->get('user.business_id');

            $cloths = Cloth::with(['styles', 'measurements'])
                ->where('business_id', $business_id)
                ->select(['id', 'cloth_name', 'serial_no', 'cloth_image', 'wages'])
                ->get();

            // Sort relationships in memory (not SQL)
            $cloths->each(function ($cloth) {
                $cloth->styles = $cloth->styles->sortBy('pivot.serial_no')->values();
                $cloth->measurements = $cloth->measurements->sortBy('pivot.serial_no')->values();
            });

            return Datatables::of($cloths)
                ->addColumn('cloth_image', function ($row) {
                    if ($row->cloth_image) {
                        $imageUrl = asset('storage/' . $row->cloth_image);
                        return '<img src="' . $imageUrl . '">';
                    } else {
                        return '<img src="/img/default.png">';
                    }
                })
                ->addColumn('measurements', function ($row) {
                    return $row->measurements->pluck('measurement_name')->implode(', ');
                })
                ->addColumn('styles', function ($row) {
                    return $row->styles->pluck('style_name')->implode(', ');
                })
                ->addColumn('action', function ($row) {
                    return '
                        <button data-href="' . action('App\Http\Controllers\ClothController@edit', [$row->id]) . '" 
                                class="tw-dw-btn tw-dw-btn-xs tw-dw-btn-outline tw-dw-btn-primary edit_cloth_button">
                            <i class="glyphicon glyphicon-edit"></i> Edit
                        </button>
                        &nbsp;
                        <button data-href="' . action('App\Http\Controllers\ClothController@destroy', [$row->id]) . '" 
                                class="tw-dw-btn tw-dw-btn-outline tw-dw-btn-xs tw-dw-btn-error delete_cloth_button">
                            <i class="glyphicon glyphicon-trash"></i> Delete
                        </button>';
                })
                ->rawColumns(['cloth_image', 'action'])
                ->make(true);
        }

        return view('cloth.index');
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

        // Check if subscribed
        if (!$this->moduleUtil->isSubscribed($business_id)) {
            return $this->moduleUtil->expiredResponse();
        } elseif (!$this->moduleUtil->isQuotaAvailable('cloths', $business_id)) {
            return response()->json([
                'success' => false,
                'msg' => 'Maximum Cloths limit reached.'
            ]);
        }

        // Fetch all styles and measurements for the dropdown
        $styles = Style::where('business_id', $business_id)->pluck('style_name', 'id');
        $measurements = Measurement::where('business_id', $business_id)->pluck('measurement_name', 'id');

        return view('cloth.create', compact('styles', 'measurements'));
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
                'cloth_name' => 'required|string|max:255',
                'serial_no' => 'required|numeric',
                'wages' => 'nullable|numeric',
                'cloth_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',

                /* 'styles' => 'array', // not required here
                'styles.*.id' => 'required|exists:styles,id',
                'styles.*.serial_no' => 'nullable|numeric',

                'measurements' => 'array', // not required here
                'measurements.*.id' => 'required|exists:measurements,id',
                'measurements.*.serial_no' => 'nullable|numeric', */
            ]);

            DB::beginTransaction();

            $business_id = $request->session()->get('user.business_id');
            $created_by = $request->session()->get('user.id');

            $imagePath = null;
            if ($request->hasFile('cloth_image')) {
                $imagePath = $request->file('cloth_image')->store('cloths', 'public');
            }

            $cloth = Cloth::create([
                'cloth_name' => $request->cloth_name,
                'serial_no' => $request->serial_no,
                'wages' => $request->wages,
                'cloth_image' => $imagePath,
                'business_id' => $business_id,
                'created_by' => $created_by,
            ]);

            // Sync styles
            /* $stylePivotData = [];
            foreach ($request->styles as $style) {
                $stylePivotData[$style['id']] = ['serial_no' => $style['serial_no']];
            }
            $cloth->styles()->sync($stylePivotData); */

            // Sync measurements
            /* $measurementPivotData = [];
            foreach ($request->measurements as $measurement) {
                $measurementPivotData[$measurement['id']] = ['serial_no' => $measurement['serial_no']];
            }
            $cloth->measurements()->sync($measurementPivotData); */

            DB::commit();

            return response()->json([
                'success' => true,
                'msg' => __('tailoring.cloth_add'),
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Cloth Store Error: " . $e->getMessage());

            return response()->json([
                'success' => false,
                'msg' => __('messages.something_went_wrong'),
            ]);
        }
    }


    // Edit form
    public function edit($id)
    {
        $cloth = Cloth::with([
            'styles' => function ($q) {
                $q->withPivot('serial_no');
            },
            'measurements' => function ($q) {
                $q->withPivot('serial_no');
            }
        ])->findOrFail($id);


        $styles = Style::pluck('style_name', 'id');
        $measurements = Measurement::pluck('measurement_name', 'id');

        $selected_styles = $cloth->styles
            ->sortBy(fn($style) => $style->pivot->serial_no ?? 999999)
            ->values()
            ->map(function ($style) {
                return (object) [
                    'id' => $style->id,
                    'style_name' => $style->style_name,
                    'serial_no' => $style->pivot->serial_no,
                ];
            });

        $selected_measurements = $cloth->measurements
            ->sortBy(fn($m) => $m->pivot->serial_no ?? 999999)
            ->values()
            ->map(function ($m) {
                return (object) [
                    'id' => $m->id,
                    'measurement_name' => $m->measurement_name,
                    'serial_no' => $m->pivot->serial_no,
                ];
            });

        $selected_style_ids = $selected_styles->pluck('id')->toArray();
        $selected_measurement_ids = $selected_measurements->pluck('id')->toArray();

        return view('cloth.edit', compact(
            'cloth',
            'styles',
            'measurements',
            'selected_styles',
            'selected_measurements',
            'selected_style_ids',
            'selected_measurement_ids'
        ));
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'cloth_name' => 'required|string|max:255',
                'serial_no' => 'required|numeric',
                'wages' => 'nullable|numeric',
                'cloth_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',

                // ✅ Both are optional now
                'styles' => 'nullable|array',
                'styles.*.id' => 'nullable|exists:styles,id',
                'styles.*.serial_no' => 'nullable|numeric',

                'measurements' => 'nullable|array',
                'measurements.*.id' => 'nullable|exists:measurements,id',
                'measurements.*.serial_no' => 'nullable|numeric',
            ]);

            $cloth = Cloth::findOrFail($id);

            // ✅ Handle image upload if provided
            $imagePath = $cloth->cloth_image;
            if ($request->hasFile('cloth_image')) {
                $imagePath = $request->file('cloth_image')->store('cloths', 'public');
            }

            // ✅ Update basic fields
            $cloth->update([
                'cloth_name' => $request->cloth_name,
                'serial_no' => $request->serial_no,
                'wages' => $request->wages,
                'cloth_image' => $imagePath,
            ]);

            // ✅ Sync styles (only if provided)
            if (!empty($request->styles)) {
                $styleSerials = array_column($request->styles, 'serial_no');
                $filteredStyleSerials = array_filter($styleSerials);

                // Prevent duplicate serial numbers
                if (count($filteredStyleSerials) !== count(array_unique($filteredStyleSerials))) {
                    return response()->json([
                        'success' => false,
                        'msg' => __('tailoring.duplicate_style_serial_no'),
                    ]);
                }

                $stylePivotData = [];
                foreach ($request->styles as $style) {
                    $stylePivotData[$style['id']] = ['serial_no' => $style['serial_no']];
                }
                $cloth->styles()->sync($stylePivotData);
            } else {
                // Optional: remove all linked styles if none selected
                $cloth->styles()->detach();
            }

            // ✅ Sync measurements (only if provided)
            if (!empty($request->measurements)) {
                $measurementSerials = array_column($request->measurements, 'serial_no');
                $filteredMeasurementSerials = array_filter($measurementSerials);

                // Prevent duplicate serial numbers
                if (count($filteredMeasurementSerials) !== count(array_unique($filteredMeasurementSerials))) {
                    return response()->json([
                        'success' => false,
                        'msg' => __('tailoring.duplicate_measurement_serial_no'),
                    ]);
                }

                $measurementPivotData = [];
                foreach ($request->measurements as $measurement) {
                    $measurementPivotData[$measurement['id']] = ['serial_no' => $measurement['serial_no']];
                }
                $cloth->measurements()->sync($measurementPivotData);
            } else {
                // Optional: remove all linked measurements if none selected
                $cloth->measurements()->detach();
            }

            return response()->json([
                'success' => true,
                'msg' => __('tailoring.cloth_update'),
            ]);
        } catch (\Exception $e) {
            Log::error('Cloth Update Error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'msg' => __('messages.something_went_wrong'),
            ]);
        }
    }

    // Delete
    public function destroy($id)
    {
        $cloth = Cloth::findOrFail($id);

        // Check if this cloth is used in any transaction of type "order"
        $exists = TransactionSellLine::where('cloth_id', $cloth->id)
            ->whereHas('transaction', function ($q) {
                $q->where('type', 'order');
            })
            ->exists();

        if ($exists) {
            return response()->json([
                'success' => false,
                'msg' => __('tailoring.cloth_cannot_delete')
            ]);
        }

        $cloth->delete();

        return response()->json([
            'success' => true,
            'msg' => __('tailoring.cloth_delete')
        ]);
    }

    public function getClothDetails($id)
    {
        $cloth = Cloth::findOrFail($id);

        /* $selected_styles = $cloth->styles
            ->sortBy(fn($style) => $style->pivot->serial_no ?? 999999)
            ->values()
            ->map(function ($style) {
                return [
                    'id' => $style->id,
                    'style_name' => $style->style_name,
                    'serial_no' => $style->pivot->serial_no,
                ];
            });

        $selected_measurements = $cloth->measurements
            ->sortBy(fn($m) => $m->pivot->serial_no ?? 999999)
            ->values()
            ->map(function ($m) {
                return [
                    'id' => $m->id,
                    'measurement_name' => $m->measurement_name,
                    'serial_no' => $m->pivot->serial_no,
                ];
            }); */

        return response()->json([
            'success' => true,
            'data' => [
                'cloth' => $cloth,
                // 'selected_styles' => $selected_styles,
                // 'selected_measurements' => $selected_measurements,
            ],
        ]);
    }

    public function getClothAllDetails(Request $request, $id)
    {
        $business_id = request()->session()->get('user.business_id');

        $all_cloths = Cloth::where('business_id', $business_id)
            ->pluck('cloth_name', 'id');

        $contact_id = $request->query('contact_id');
        $cloth = Cloth::with([
            'styles' => function ($q) {
                $q->orderBy('cloth_style.serial_no', 'asc');
            },
            'styles.designs',
            'measurements' => function ($q) {
                $q->orderBy('cloth_measurement.serial_no', 'asc');
            },
            'measurements.subMeasurements'
        ])->find($id);

        $cloth_customization = ClothCustomization::where('cloth_id', $id)
            ->where('contact_id', $contact_id)
            ->first();

        $view_only = $request->query('view_only');

        $print_only = $request->query('print_only');

        if (request()->ajax()) {
            if (!empty($print_only)) {
                $business_details = $this->businessUtil->getDetails($business_id);
                $location_details = BusinessLocation::where('business_id', $business_id)->first();
                $contact = Contact::find($contact_id);
                return view('cloth.print', compact(
                    'cloth',
                    'contact',
                    'business_details',
                    'location_details',
                    'cloth_customization'
                ))->render();
            }
            return view('cloth.add_style_measurement', compact(
                'cloth',
                'contact_id',
                'cloth_customization',
                'all_cloths',
                'view_only'
            ))->render();
        }

        return view('cloth.add_style_measurement', compact(
            'cloth',
            'contact_id',
            'cloth_customization',
            'all_cloths',
            'view_only'
        ));
    }
}
