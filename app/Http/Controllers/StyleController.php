<?php

namespace App\Http\Controllers;

use App\Design;
use App\Style;
use App\Cloth;
use App\Utils\ModuleUtil;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;


class StyleController extends Controller
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

            $styles = Style::with('designs') // Eager load designs
                ->where('business_id', $business_id)
                ->orderByRaw('ISNULL(serial_no), serial_no ASC')
                ->select(['style_name', 'serial_no', 'id']);

            return Datatables::of($styles)
                /* ->addColumn('designs', function ($row) {
                    // Generate image tags for all design images
                    return $row->designs->map(function ($design) {
                        if ($design->design_image) {
                            $imageUrl = asset('storage/' . $design->design_image);
                            return '<img src="' . $imageUrl . '">';
                        } else {
                            return '<span class="text-muted">No Image</span>';
                        }
                    })->implode(' ');
                }) */
                ->addColumn('designs', function ($row) {
                    return $row->designs->map(function ($design) {
                        $imageHtml = $design->design_image
                            ? '<img src="' . asset('storage/' . $design->design_image) . '">'
                            : '<img src="/img/default.png">';

                        return '<div class="design-data">
                    ' . $imageHtml . '
                    <p>' . e($design->design_name) . '</p>
                </div>';
                    })->implode('');
                })
                ->addColumn('cloth', function ($row) {
                    return $row->cloths->pluck('cloth_name')->implode(', ');
                })
                ->addColumn('action', function ($row) {
                    return '
                <button data-href="' . action('App\Http\Controllers\StyleController@edit', [$row->id]) . '" 
                        class="tw-dw-btn tw-dw-btn-xs tw-dw-btn-outline tw-dw-btn-primary edit_style_button">
                    <i class="glyphicon glyphicon-edit"></i> Edit
                </button>
                &nbsp;
                <button data-href="' . action('App\Http\Controllers\StyleController@destroy', [$row->id]) . '" 
                        class="tw-dw-btn tw-dw-btn-outline tw-dw-btn-xs tw-dw-btn-error delete_style_button">
                    <i class="glyphicon glyphicon-trash"></i> Delete
                </button>';
                })
                ->rawColumns(['designs', 'action']) // Make sure to include 'designs' here
                ->make(true);
        }

        return view('style.index');
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

        $cloths = Cloth::where('business_id', $business_id)
            ->pluck('cloth_name', 'id');

        //Check if subscribed or not
        if (!$this->moduleUtil->isSubscribed($business_id)) {
            return $this->moduleUtil->expiredResponse();
        }

        return view('style.create', compact('cloths'));
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
                'style_name' => 'required|string|max:255',
                'serial_no' => 'nullable',
                'designs.*.name' => 'required|string|max:255',
                'designs.*.serial_no' => 'required',
                'designs.*.image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048'
            ]);

            $business_id = $request->session()->get('user.business_id');
            $created_by = $request->session()->get('user.id');

            $style = Style::create([
                'style_name' => $request->style_name,
                'serial_no' => $request->serial_no,
                'business_id' => $business_id,
                'created_by' => $created_by,
            ]);

            $style->cloths()->sync($request->input('cloths'));

            if ($request->has('designs')) {
                foreach ($request->designs as $index => $designData) {
                    $designImage = $designData['image'] ?? null;
                    $imagePath = null;

                    if ($designImage) {
                        $imagePath = $designImage->store('designs', 'public');
                    }

                    $style->designs()->create([
                        'design_name' => $designData['name'],
                        'serial_no' => $designData['serial_no'],
                        'design_image' => $imagePath,
                    ]);
                }
            }
            return response()->json([
                'success' => true,
                'msg' => __('tailoring.style_add'),
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Style Store Error: " . $e->getMessage());
            return response()->json([
                'success' => false,
                'msg' => __('messages.something_went_wrong'),
            ]);
        }
    }

    // Edit form
    public function edit($id)
    {
        $business_id = request()->session()->get('user.business_id');
        $style = Style::with('designs')->findOrFail($id);
        $cloths = Cloth::where('business_id', $business_id)
            ->pluck('cloth_name', 'id');
        return view('style.edit', compact('style', 'cloths'));
    }

    // Update
    public function update(Request $request, $id)
    {
        $request->validate([
            'style_name' => 'required|string|max:255',
            'serial_no' => 'nullable',
            'designs.*.name' => 'required|string|max:255',
            'designs.*.serial_no' => 'required',
            'designs.*.image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $style = Style::findOrFail($id);

        $style->update([
            'style_name' => $request->style_name,
            'serial_no' => $request->serial_no,
        ]);

        $style->cloths()->sync($request->input('cloths'));

        if ($request->has('designs')) {
            $submittedIds = [];

            foreach ($request->designs as $designData) {
                $design = Design::findOrNew($designData['id'] ?? null);
                $design->style_id = $style->id;
                $design->design_name = $designData['name'];
                $design->serial_no = $designData['serial_no'];

                if (isset($designData['image'])) {
                    $designImage = $designData['image'];
                    $path = $designImage->store('designs', 'public');
                    $design->design_image = $path;
                }

                $design->save();
                if ($design->id) {
                    $submittedIds[] = $design->id;
                }
            }

            // Delete designs that are not in submitted IDs
            $style->designs()->whereNotIn('id', $submittedIds)->delete();
        }
        return response()->json([
            'success' => true,
            'msg' => __('tailoring.style_update'),
        ]);
    }

    // Delete
    public function destroy($id)
    {
        $style = Style::findOrFail($id);

        // Check if measurement is linked with any cloth
        if ($style->cloths()->exists()) {
            return response()->json([
                'success' => false,
                'msg' => __('tailoring.style_cannot_delete')
            ]);
        }

        $style->delete();

        return response()->json([
            'success' => true,
            'msg' => __('tailoring.style_delete')
        ]);
    }
}
