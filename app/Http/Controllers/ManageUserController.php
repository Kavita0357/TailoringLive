<?php

namespace App\Http\Controllers;

use App\BusinessLocation;
use App\User;
use App\Utils\ModuleUtil;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Activitylog\Models\Activity;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;
use App\Events\UserCreatedOrModified;
use App\TailorMasterList;
use App\Transaction;

class ManageUserController extends Controller
{
    /**
     * Constructor
     *
     * @param  Util  $commonUtil
     * @return void
     */
    public function __construct(ModuleUtil $moduleUtil)
    {
        $this->moduleUtil = $moduleUtil;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!auth()->user()->can('user.view') && !auth()->user()->can('user.create')) {
            abort(403, 'Unauthorized action.');
        }

        if (request()->ajax()) {
            $business_id = request()->session()->get('user.business_id');
            $user_id = request()->session()->get('user.id');

            $users = User::where('business_id', $business_id)
                ->user()
                ->where('is_cmmsn_agnt', 0)
                ->select([
                    'id',
                    'username',
                    DB::raw("CONCAT(COALESCE(surname, ''), ' ', COALESCE(first_name, ''), ' ', COALESCE(last_name, '')) as full_name"),
                    'email',
                    'allow_login',
                ]);

            return Datatables::of($users)
                ->editColumn('username', '{{$username}} @if(empty($allow_login)) <span class="label bg-gray">@lang("lang_v1.login_not_allowed")</span>@endif')
                ->addColumn(
                    'role',
                    function ($row) {
                        $role_name = $this->moduleUtil->getUserRoleName($row->id);

                        return $role_name;
                    }
                )
                ->addColumn(
                    'action',
                    '@can("user.update")
                        <a href="{{action(\'App\Http\Controllers\ManageUserController@edit\', [$id])}}" class="tw-dw-btn tw-dw-btn-xs tw-dw-btn-outline tw-dw-btn-primary"><i class="glyphicon glyphicon-edit"></i> @lang("messages.edit")</a>
                        &nbsp;
                    @endcan
                    @can("user.view")
                    <a href="{{action(\'App\Http\Controllers\ManageUserController@show\', [$id])}}" class="tw-dw-btn tw-dw-btn-xs tw-dw-btn-outline  tw-dw-btn-info"><i class="fa fa-eye"></i> @lang("messages.view")</a>
                    &nbsp;
                    @endcan
                    @can("user.delete")
                        <button data-href="{{action(\'App\Http\Controllers\ManageUserController@destroy\', [$id])}}" class="tw-dw-btn tw-dw-btn-outline tw-dw-btn-xs tw-dw-btn-error delete_user_button"><i class="glyphicon glyphicon-trash"></i> @lang("messages.delete")</button>
                    @endcan'
                )
                ->filterColumn('full_name', function ($query, $keyword) {
                    $query->whereRaw("CONCAT(COALESCE(surname, ''), ' ', COALESCE(first_name, ''), ' ', COALESCE(last_name, '')) like ?", ["%{$keyword}%"]);
                })
                ->removeColumn('id')
                ->rawColumns(['action', 'username'])
                ->make(true);
        }

        return view('manage_user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!auth()->user()->can('user.create')) {
            abort(403, 'Unauthorized action.');
        }

        $business_id = request()->session()->get('user.business_id');

        //Check if subscribed or not, then check for users quota
        if (!$this->moduleUtil->isSubscribed($business_id)) {
            return $this->moduleUtil->expiredResponse();
        } elseif (!$this->moduleUtil->isQuotaAvailable('users', $business_id)) {
            return $this->moduleUtil->quotaExpiredResponse('users', $business_id, action([\App\Http\Controllers\ManageUserController::class, 'index']));
        }

        $roles = $this->getRolesArray($business_id);
        $username_ext = $this->moduleUtil->getUsernameExtension();
        $locations = BusinessLocation::where('business_id', $business_id)
            ->Active()
            ->get();

        //Get user form part from modules
        $form_partials = $this->moduleUtil->getModuleData('moduleViewPartials', ['view' => 'manage_user.create']);

        return view('manage_user.create')
            ->with(compact('roles', 'username_ext', 'locations', 'form_partials'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!auth()->user()->can('user.create')) {
            abort(403, 'Unauthorized action.');
        }

        try {
            if (!empty($request->input('dob'))) {
                $request['dob'] = $this->moduleUtil->uf_date($request->input('dob'));
            }

            $request['cmmsn_percent'] = !empty($request->input('cmmsn_percent')) ? $this->moduleUtil->num_uf($request->input('cmmsn_percent')) : 0;

            $request['max_sales_discount_percent'] = !is_null($request->input('max_sales_discount_percent')) ? $this->moduleUtil->num_uf($request->input('max_sales_discount_percent')) : null;

            $user = $this->moduleUtil->createUser($request);

            event(new UserCreatedOrModified($user, 'added'));

            $output = [
                'success' => 1,
                'msg' => __('user.user_added'),
            ];
        } catch (\Exception $e) {
            \Log::emergency('File:' . $e->getFile() . 'Line:' . $e->getLine() . 'Message:' . $e->getMessage());

            $output = [
                'success' => 0,
                'msg' => __('messages.something_went_wrong'),
            ];
        }

        return redirect('users')->with('status', $output);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!auth()->user()->can('user.view')) {
            abort(403, 'Unauthorized action.');
        }

        $business_id = request()->session()->get('user.business_id');

        $user = User::where('business_id', $business_id)
            ->with(['contactAccess'])
            ->find($id);

        //Get user view part from modules
        $view_partials = $this->moduleUtil->getModuleData('moduleViewPartials', ['view' => 'manage_user.show', 'user' => $user]);

        $users = User::forDropdown($business_id, false);

        $activities = Activity::forSubject($user)
            ->with(['causer', 'subject'])
            ->latest()
            ->get();

        return view('manage_user.show')->with(compact('user', 'view_partials', 'users', 'activities'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!auth()->user()->can('user.update')) {
            abort(403, 'Unauthorized action.');
        }

        $business_id = request()->session()->get('user.business_id');
        $user = User::where('business_id', $business_id)
            ->with(['contactAccess'])
            ->findOrFail($id);

        $roles = $this->getRolesArray($business_id);

        $contact_access = $user->contactAccess->pluck('name', 'id')->toArray();

        if ($user->status == 'active') {
            $is_checked_checkbox = true;
        } else {
            $is_checked_checkbox = false;
        }

        $locations = BusinessLocation::where('business_id', $business_id)
            ->get();

        $permitted_locations = $user->permitted_locations();
        $username_ext = $this->moduleUtil->getUsernameExtension();

        //Get user form part from modules
        $form_partials = $this->moduleUtil->getModuleData('moduleViewPartials', ['view' => 'manage_user.edit', 'user' => $user]);

        return view('manage_user.edit')
            ->with(compact('roles', 'user', 'contact_access', 'is_checked_checkbox', 'locations', 'permitted_locations', 'form_partials', 'username_ext'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //Disable in demo
        $notAllowed = $this->moduleUtil->notAllowedInDemo();
        if (!empty($notAllowed)) {
            return $notAllowed;
        }

        if (!auth()->user()->can('user.update')) {
            abort(403, 'Unauthorized action.');
        }

        try {
            $user_data = $request->only([
                'surname',
                'first_name',
                'last_name',
                'email',
                'selected_contacts',
                'marital_status',
                'blood_group',
                'contact_number',
                'fb_link',
                'twitter_link',
                'social_media_1',
                'social_media_2',
                'permanent_address',
                'current_address',
                'guardian_name',
                'custom_field_1',
                'custom_field_2',
                'custom_field_3',
                'custom_field_4',
                'id_proof_name',
                'id_proof_number',
                'cmmsn_percent',
                'gender',
                'max_sales_discount_percent',
                'family_number',
                'alt_number',
                'is_enable_service_staff_pin',
                'wages'
            ]);

            $user_data['status'] = !empty($request->input('is_active')) ? 'active' : 'inactive';

            $user_data['is_enable_service_staff_pin'] = !empty($request->input('is_enable_service_staff_pin')) ? true : false;

            $business_id = request()->session()->get('user.business_id');

            if (!isset($user_data['selected_contacts'])) {
                $user_data['selected_contacts'] = 0;
            }

            if (!isset($user_data['wages'])) {
                $user_data['wages'] = null;
            }

            if (empty($request->input('allow_login'))) {
                $user_data['username'] = null;
                $user_data['password'] = null;
                $user_data['allow_login'] = 0;
            } else {
                $user_data['allow_login'] = 1;
            }

            if (!empty($request->input('password'))) {
                $user_data['password'] = $user_data['allow_login'] == 1 ? Hash::make($request->input('password')) : null;
            }


            if (!empty($request->input('service_staff_pin'))) {
                $user_data['service_staff_pin'] = $request->input('service_staff_pin');
            }


            //Sales commission percentage
            $user_data['cmmsn_percent'] = !empty($user_data['cmmsn_percent']) ? $this->moduleUtil->num_uf($user_data['cmmsn_percent']) : 0;

            $user_data['max_sales_discount_percent'] = !is_null($user_data['max_sales_discount_percent']) ? $this->moduleUtil->num_uf($user_data['max_sales_discount_percent']) : null;

            // Normalize wages numeric format (handles formatted input like 1,000.00)
            if (isset($user_data['wages']) && $user_data['wages'] !== null && $user_data['wages'] !== '') {
                $user_data['wages'] = $this->moduleUtil->num_uf($user_data['wages']);
            } else {
                $user_data['wages'] = null;
            }

            if (!empty($request->input('dob'))) {
                $user_data['dob'] = $this->moduleUtil->uf_date($request->input('dob'));
            }

            if (!empty($request->input('bank_details'))) {
                $user_data['bank_details'] = json_encode($request->input('bank_details'));
            }

            DB::beginTransaction();

            if ($user_data['allow_login'] && $request->has('username')) {
                $user_data['username'] = $request->input('username');
                $ref_count = $this->moduleUtil->setAndGetReferenceCount('username');
                if (blank($user_data['username'])) {
                    $user_data['username'] = $this->moduleUtil->generateReferenceNumber('username', $ref_count);
                }

                $username_ext = $this->moduleUtil->getUsernameExtension();
                if (!empty($username_ext)) {
                    $user_data['username'] .= $username_ext;
                }
            }

            $user = User::where('business_id', $business_id)
                ->findOrFail($id);

            $user->update($user_data);
            $role_id = $request->input('role');
            $user_role = $user->roles->first();
            $previous_role = !empty($user_role->id) ? $user_role->id : 0;
            if ($previous_role != $role_id) {
                $is_admin = $this->moduleUtil->is_admin($user);
                $all_admins = $this->getAdmins();
                //If only one admin then can not change role
                if ($is_admin && count($all_admins) <= 1) {
                    throw new \Exception(__('lang_v1.cannot_change_role'));
                }
                if (!empty($previous_role)) {
                    $user->removeRole($user_role->name);
                }

                $role = Role::findOrFail($role_id);
                $user->assignRole($role->name);
            }

            //Grant Location permissions
            $this->moduleUtil->giveLocationPermissions($user, $request);

            //Assign selected contacts
            if ($user_data['selected_contacts'] == 1) {
                $contact_ids = $request->get('selected_contact_ids');
            } else {
                $contact_ids = [];
            }
            $user->contactAccess()->sync($contact_ids);

            //Update module fields for user
            $this->moduleUtil->getModuleData('afterModelSaved', ['event' => 'user_saved', 'model_instance' => $user]);

            $this->moduleUtil->activityLog($user, 'edited', null, ['name' => $user->user_full_name]);

            event(new UserCreatedOrModified($user, 'updated'));

            $output = [
                'success' => 1,
                'msg' => __('user.user_update_success'),
            ];

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            \Log::emergency('File:' . $e->getFile() . 'Line:' . $e->getLine() . 'Message:' . $e->getMessage());

            $output = [
                'success' => 0,
                'msg' => $e->getMessage(),
            ];
        }

        return redirect('users')->with('status', $output);
    }

    private function getAdmins()
    {
        $business_id = request()->session()->get('user.business_id');
        $admins = User::role('Admin#' . $business_id)->get();

        return $admins;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Disable in demo
        $notAllowed = $this->moduleUtil->notAllowedInDemo();
        if (!empty($notAllowed)) {
            return $notAllowed;
        }

        if (!auth()->user()->can('user.delete')) {
            abort(403, 'Unauthorized action.');
        }

        if (request()->ajax()) {
            try {
                $business_id = request()->session()->get('user.business_id');

                $user = User::where('business_id', $business_id)
                    ->findOrFail($id);

                $this->moduleUtil->activityLog($user, 'deleted', null, ['name' => $user->user_full_name, 'id' => $user->id]);

                $user->delete();
                event(new UserCreatedOrModified($user, 'deleted'));

                $output = [
                    'success' => true,
                    'msg' => __('user.user_delete_success'),
                ];
            } catch (\Exception $e) {
                \Log::emergency('File:' . $e->getFile() . 'Line:' . $e->getLine() . 'Message:' . $e->getMessage());

                $output = [
                    'success' => false,
                    'msg' => __('messages.something_went_wrong'),
                ];
            }

            return $output;
        }
    }

    /**
     * Retrives roles array (Hides admin role from non admin users)
     *
     * @param  int  $business_id
     * @return array $roles
     */
    private function getRolesArray($business_id)
    {
        $roles_array = Role::where('business_id', $business_id)->get()->pluck('name', 'id');
        $roles = [];

        $is_admin = $this->moduleUtil->is_admin(auth()->user(), $business_id);

        foreach ($roles_array as $key => $value) {
            if (!$is_admin && $value == 'Admin#' . $business_id) {
                continue;
            }
            $roles[$key] = str_replace('#' . $business_id, '', $value);
        }

        return $roles;
    }

    /**
     * Signes in from user id
     *
     * @param  int  $id
     */
    public function signInAsUser($id)
    {
        if (!auth()->user()->can('superadmin') && empty(session('previous_user_id'))) {
            abort(403, 'Unauthorized action.');
        }

        $user_id = auth()->user()->id;
        $username = auth()->user()->username;
        session()->flush();

        if (request()->has('save_current')) {
            session(['previous_user_id' => $user_id, 'previous_username' => $username]);
        }

        Auth::loginUsingId($id);

        return redirect()->route('home');
    }

    public function tailorMasterDashboard()
    {
        $business_id = request()->session()->get('user.business_id');

        $business_locations = BusinessLocation::forDropdown($business_id);

        $location_id = request()->input('location_id');

        $tailor_masters_query = TailorMasterList::whereHas('user', function ($query) use ($business_id) {
            $query->where('business_id', $business_id)
                ->whereHas('roles', function ($q) use ($business_id) {
                    $q->where('name', 'Tailor Master#' . $business_id);
                });
        });



        $tailor_masters = $tailor_masters_query->get();

        $total_tailor_masters = $tailor_masters->count();

        if (!empty($location_id)) {
            // Fetch completed orders (transactions) for this location
            $orders = Transaction::where('transactions.business_id', $business_id)
                ->where('transactions.type', 'order')
                ->where('transactions.location_id', $location_id)
                ->whereHas('sell_lines', function ($query) {
                    $query->whereNotNull('tailoring_master_id');
                })
                ->with(['sell_lines.cloth', 'payment_lines'])
                ->get();

            $total_wages = 0;
            $total_wages_paid = 0;
            $total_wages_due = 0;
            $total_completed_orders = 0;

            foreach ($orders as $order) {
                $order_wages = 0;
                foreach ($order->sell_lines as $line) {
                    if (!empty($line->tailoring_master_id) && !empty($line->cloth)) {
                        $quantity = $line->assigned_quantity ?? $line->quantity;
                        $order_wages += ($line->cloth->wages ?? 0) * $quantity;
                        $total_completed_orders += $quantity;
                    }
                }
                $total_wages += $order_wages;

                $order_paid = $order->payment_lines->sum('amount');
                $total_wages_paid += $order_paid;

                $total_wages_due += max(0, $order->final_total - $order_paid);
            }
        } else {
            $total_wages = $tailor_masters->sum('total_wages');
            $total_wages_paid = $tailor_masters->sum('total_wages_paid');
            $total_wages_due = $tailor_masters->sum('total_wages_due');
            $total_completed_orders = $tailor_masters->sum('total_completed_orders');
        }

        return view('tailor_master.dashboard')
            ->with(compact(
                'total_tailor_masters',
                'total_completed_orders',
                'total_wages',
                'total_wages_paid',
                'total_wages_due',
                'business_locations',
                'location_id',
                'tailor_masters'
            ));
    }

    public function getAllTailorMasters()
    {
        if (!auth()->user()->can('user.view') && !auth()->user()->can('user.create')) {
            abort(403, 'Unauthorized action.');
        }

        if (request()->ajax()) {
            $business_id = request()->session()->get('user.business_id');

            if (request()->has('is_dashboard') && request()->input('is_dashboard') == 'true') {
                $location_id = request()->input('location_id');
                $tailoring_master_id = request()->input('tailoring_master_id');

                $orders = Transaction::where('transactions.business_id', $business_id)
                    ->where('transactions.type', 'order')
                    ->whereHas('sell_lines', function ($query) use ($tailoring_master_id) {
                        $query->whereNotNull('tailoring_master_id');
                        if (!empty($tailoring_master_id)) {
                            $query->where('tailoring_master_id', $tailoring_master_id);
                        }
                    })
                    ->with([
                        'contact',
                        'sell_lines.tailor_master',
                        'sell_lines.cloth',
                        'payment_lines'
                    ])
                    ->select('transactions.*');

                if (request()->has('location_id') && !empty(request()->input('location_id'))) {
                    $orders->where('transactions.location_id', request()->input('location_id'));
                }

                $filtered_orders = $orders->get();

                $total_wages = 0;
                $total_wages_paid = 0;
                $total_wages_due = 0;
                $total_completed_orders = 0;

                foreach ($filtered_orders as $order) {
                    $order_wages = 0;
                    foreach ($order->sell_lines as $line) {
                        if (!empty($line->tailoring_master_id) && !empty($line->cloth)) {
                            if (!empty($tailoring_master_id) && $line->tailoring_master_id != $tailoring_master_id) {
                                continue;
                            }
                            $quantity = $line->assigned_quantity ?? $line->quantity;
                            $order_wages += ($line->cloth->wages ?? 0) * $quantity;
                            $total_completed_orders += $quantity;
                        }
                    }
                    $total_wages += $order_wages;

                    $order_paid = $order->payment_lines->sum('amount');
                    $total_wages_paid += $order_paid;

                    $total_wages_due += max(0, $order->final_total - $order_paid);
                }

                $tailor_masters_query = TailorMasterList::whereHas('user', function ($query) use ($business_id) {
                    $query->where('business_id', $business_id)
                        ->whereHas('roles', function ($q) use ($business_id) {
                            $q->where('name', 'Tailor Master#' . $business_id);
                        });
                });



                $tailor_masters = $tailor_masters_query->get();

                if (!empty($tailoring_master_id)) {
                    $total_tailor_masters = $tailor_masters->where('user_id', $tailoring_master_id)->count();
                } else {
                    $total_tailor_masters = $tailor_masters->count();
                }

                if (empty($location_id) && empty($tailoring_master_id)) {
                    $total_wages = $tailor_masters->sum('total_wages');
                    $total_wages_paid = $tailor_masters->sum('total_wages_paid');
                    $total_wages_due = $tailor_masters->sum('total_wages_due');
                    $total_completed_orders = $tailor_masters->sum('total_completed_orders');
                }

                return DataTables::of($orders)
                    ->editColumn('added_on', function ($row) {
                        return \Carbon::parse($row->transaction_date)->format(session('business.date_format') . ' H:i');
                    })
                    ->addColumn('particulars', function ($row) {
                        $particulars = [];
                        $filter_tailor_id = request()->input('tailoring_master_id');
                        foreach ($row->sell_lines as $line) {
                            if (!empty($line->cloth) && !empty($line->tailoring_master_id)) {
                                if (!empty($filter_tailor_id) && $line->tailoring_master_id != $filter_tailor_id) {
                                    continue;
                                }
                                $quantity = $line->assigned_quantity ?? $line->quantity;
                                $particulars[] = $line->cloth->cloth_name . ' ' . (int) $quantity . 'pc(s)';
                            }
                        }
                        return implode(', ', $particulars);
                    })
                    ->addColumn('total_wages', function ($row) {
                        $wages = 0;
                        $filter_tailor_id = request()->input('tailoring_master_id');
                        foreach ($row->sell_lines as $line) {
                            if (!empty($line->tailoring_master_id) && !empty($line->cloth)) {
                                if (!empty($filter_tailor_id) && $line->tailoring_master_id != $filter_tailor_id) {
                                    continue;
                                }
                                $quantity = $line->assigned_quantity ?? $line->quantity;
                                $wages += ($line->cloth->wages ?? 0) * $quantity;
                            }
                        }
                        return $wages;
                    })
                    ->addColumn('tailor_master', function ($row) {
                        $names = [];
                        $filter_tailor_id = request()->input('tailoring_master_id');
                        foreach ($row->sell_lines as $line) {
                            if (!empty($filter_tailor_id) && $line->tailoring_master_id != $filter_tailor_id) {
                                continue;
                            }
                            if (!empty($line->tailor_master)) {
                                $names[] = $line->tailor_master->name;
                            } elseif (!empty($line->tailoring_master_id)) {
                                $tailor = \App\TailorMasterList::where('user_id', $line->tailoring_master_id)->first();
                                if ($tailor) {
                                    $names[] = $tailor->name;
                                } else {
                                    $user = \App\User::find($line->tailoring_master_id);
                                    if ($user) {
                                        $names[] = trim($user->surname . ' ' . $user->first_name . ' ' . $user->last_name);
                                    }
                                }
                            }
                        }
                        return implode(', ', array_unique(array_filter($names)));
                    })
                    ->editColumn('payment_status', function ($row) {
                        $payment_status = Transaction::getPaymentStatus($row);
                        return (string) view('sell.partials.payment_status', ['payment_status' => $payment_status, 'id' => $row->id]);
                    })
                    ->addColumn('total_wages_paid', function ($row) {
                        return $row->payment_lines->sum('amount');
                    })
                    ->addColumn('total_wages_due', function ($row) {
                        $total_paid = $row->payment_lines->sum('amount');
                        return max(0, $row->final_total - $total_paid);
                    })
                    ->rawColumns(['payment_status'])
                    ->with([
                        'totals' => [
                            'total_tailor_masters' => $total_tailor_masters,
                            'total_completed_orders' => $total_completed_orders,
                            'total_wages' => $total_wages,
                            'total_wages_paid' => $total_wages_paid,
                            'total_wages_due' => $total_wages_due,
                        ]
                    ])
                    ->make(true);
            }

            $tailor_master_role_name = 'Tailor Master#' . $business_id;

            $tailor_masters = TailorMasterList::whereHas('user', function ($query) use ($business_id, $tailor_master_role_name) {
                $query->where('business_id', $business_id)
                    ->whereHas('roles', function ($q) use ($tailor_master_role_name) {
                        $q->where('name', $tailor_master_role_name);
                    });
            })->select([
                        'id',
                        'user_id',
                        'name',
                        'mobile',
                        'added_on',
                        'is_active',
                        'total_completed_orders',
                        'total_wages',
                        'total_wages_paid',
                        'total_wages_due',
                    ]);

            return DataTables::of($tailor_masters)
                ->editColumn('added_on', '{{@format_date($added_on)}}')
                ->editColumn('name', function ($row) {
                    if ($row->is_active == 'inactive') {
                        return $row->name . ' <small class="label pull-right bg-red no-print">' . __('lang_v1.inactive') . '</small>';
                    } else {
                        return $row->name;
                    }
                })
                ->addColumn('tailor_master', function ($row) {
                    return $row->name;
                })
                ->addColumn('particulars', function ($row) {
                    $sell_lines = \App\TransactionSellLine::whereIn('tailoring_master_id', [$row->id, $row->user_id])
                        ->with('cloth')
                        ->get();

                    $particulars = [];
                    foreach ($sell_lines as $line) {
                        if (!empty($line->cloth)) {
                            $quantity = $line->assigned_quantity ?? $line->quantity;
                            $particulars[] = $line->cloth->cloth_name . ' ' . (int) $quantity . 'pc(s)';
                        }
                    }
                    return implode(', ', array_unique($particulars));
                })
                ->addColumn('payment_status', function ($row) {
                    if ($row->total_wages_due > 0) {
                        return '<span class="label bg-yellow">' . __('lang_v1.due') . '</span>';
                    } else {
                        return '<span class="label bg-green">' . __('lang_v1.paid') . '</span>';
                    }
                })
                ->addColumn('action', function ($row) {
                    $html = '<div class="btn-group">
                        <button type="button" class="tw-dw-btn tw-dw-btn-xs tw-dw-btn-outline tw-dw-btn-info tw-w-max dropdown-toggle" data-toggle="dropdown" aria-expanded="false">' .
                        __('messages.actions') . '<span class="caret"></span><span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-left" role="menu">';

                    $html .= '<li><a href="' . action([\App\Http\Controllers\ManageUserController::class, 'getPayTailorMasterDue'], [$row->id]) . '" class="pay_tailor_due"><i class="fas fa-money-bill-alt" aria-hidden="true"></i>' . __('lang_v1.pay') . '</a></li>';

                    if (auth()->user()->can('user.view')) {
                        $html .= '<li><a href="' . action([self::class, 'showTailorMaster'], [$row->id]) . '"><i class="fas fa-eye" aria-hidden="true"></i> ' . __('messages.view') . '</a></li>';
                    }

                    if (auth()->user()->can('user.update')) {
                        $html .= '<li><a href="#" data-href="' . action([self::class, 'editTailorMaster'], [$row->id]) . '" class="btn-modal" data-container=".user_modal"><i class="glyphicon glyphicon-edit"></i> ' . __('messages.edit') . '</a></li>';
                    }

                    if (auth()->user()->can('user.delete')) {
                        $html .= '<li><a href="#" data-href="' . action([self::class, 'destroyTailorMaster'], [$row->id]) . '" class="delete_user_button"><i class="glyphicon glyphicon-trash"></i> ' . __('messages.delete') . '</a></li>';
                    }

                    if (auth()->user()->can('user.update')) {
                        $html .= '<li><a href="' . action([self::class, 'updateTailorMasterStatus'], [$row->id]) . '" class="update_tailor_status"><i class="fas fa-power-off"></i> ';

                        if ($row->is_active == 'active') {
                            $html .= __('messages.deactivate');
                        } else {
                            $html .= __('messages.activate');
                        }

                        $html .= '</a></li>';
                    }

                    $html .= '<li class="divider"></li>';

                    if (auth()->user()->can('user.view')) {
                        $html .= '<li><a href="#"><i class="fas fa-scroll" aria-hidden="true"></i> ' . __('lang_v1.ledger') . '</a></li>';
                    }

                    $html .= '<li><a href="#"><i class="fas fa-cut" aria-hidden="true"></i> ' . __('tailoring.cloths_made') . '</a></li>';
                    $html .= '</ul></div>';

                    return $html;
                })
                ->rawColumns(['action', 'name', 'payment_status'])
                ->make(true);
        }

        $business_id = request()->session()->get('user.business_id');
        $form_id = 'tailor_master_add_form';
        $tailor_master_role_id = Role::where(
            'name',
            'Tailor Master#' . $business_id
        )->value('id');
        $users = User::allTailorMasterUsers($business_id)->prepend(__('lang_v1.none'), '');

        return view('tailor_master.tailoring_master_list')
            ->with(compact('form_id', 'tailor_master_role_id', 'users'));
    }

    public function storeTailorMaster(Request $request)
    {
        try {

            $request->validate([
                'assigned_to_users' => 'required',
                'first_name' => 'required|string|max:255',
                'contact_number' => 'required'
            ]);

            TailorMasterList::create([
                'user_id' => $request->assigned_to_users,
                'name' => $request->first_name,
                'mobile' => $request->contact_number,
                'added_on' => now(),
                'total_completed_orders' => 0,
                'total_wages' => 0,
                'total_wages_paid' => 0,
                'total_wages_due' => 0,
            ]);

            $output = [
                'success' => true,
                'msg' => __('messages.success')
            ];
        } catch (\Exception $e) {

            \Log::error(
                'File:' . $e->getFile() .
                ' Line:' . $e->getLine() .
                ' Message:' . $e->getMessage()
            );

            $output = [
                'success' => false,
                'msg' => __('messages.something_went_wrong')
            ];
        }

        return redirect()->back()->with('status', $output);
    }

    public function getUserDetails($id)
    {
        $user = User::select('first_name', 'last_name', 'contact_number', 'surname')
            ->find($id);

        if (!$user) {
            return response()->json([
                'success' => false
            ]);
        }

        return response()->json([
            'success' => true,
            'name' => trim($user->surname . ' ' . $user->first_name . ' ' . $user->last_name),
            'mobile' => $user->contact_number
        ]);
    }

    public function editTailorMaster($id)
    {
        $business_id = request()->session()->get('user.business_id');
        $tailor = TailorMasterList::whereHas('user', function ($query) use ($business_id) {
            $query->where('business_id', $business_id);
        })->findOrFail($id);

        $users = User::allTailorMasterUsers($business_id)->prepend(__('lang_v1.none'), '');

        return view('tailor_master.edit')
            ->with(compact('tailor', 'users'));
    }

    public function updateTailorMaster(Request $request, $id)
    {
        try {
            $request->validate([
                'first_name' => 'required|string|max:255',
                'contact_number' => 'required'
            ]);

            $business_id = request()->session()->get('user.business_id');
            $tailor = TailorMasterList::whereHas('user', function ($query) use ($business_id) {
                $query->where('business_id', $business_id);
            })->findOrFail($id);

            $tailor->update([
                'name' => $request->first_name,
                'mobile' => $request->contact_number,
            ]);

            $output = [
                'success' => true,
                'msg' => __('messages.success')
            ];
        } catch (\Exception $e) {
            \Log::error(
                'File:' . $e->getFile() .
                ' Line:' . $e->getLine() .
                ' Message:' . $e->getMessage()
            );

            $output = [
                'success' => false,
                'msg' => __('messages.something_went_wrong')
            ];
        }

        if ($request->ajax() || $request->expectsJson()) {
            return response()->json($output);
        }

        return redirect()->route('tailor_master.list')->with('status', $output);
    }

    public function updateTailorMasterStatus($id)
    {
        if (!auth()->user()->can('user.update')) {
            abort(403, 'Unauthorized action.');
        }

        if (request()->ajax()) {
            try {
                $business_id = request()->session()->get('user.business_id');

                $tailor = TailorMasterList::whereHas('user', function ($query) use ($business_id) {
                    $query->where('business_id', $business_id);
                })->findOrFail($id);

                $tailor->is_active = $tailor->is_active == 'active' ? 'inactive' : 'active';
                $tailor->save();

                $output = [
                    'success' => true,
                    'msg' => __('messages.success'),
                ];
            } catch (\Exception $e) {
                \Log::error(
                    'File:' . $e->getFile() .
                    ' Line:' . $e->getLine() .
                    ' Message:' . $e->getMessage()
                );

                $output = [
                    'success' => false,
                    'msg' => __('messages.something_went_wrong')
                ];
            }

            return response()->json($output);
        }
    }

    public function destroyTailorMaster($id)
    {
        if (request()->ajax()) {
            try {
                $business_id = request()->session()->get('user.business_id');

                $tailor = TailorMasterList::whereHas('user', function ($query) use ($business_id) {
                    $query->where('business_id', $business_id);
                })->findOrFail($id);

                $tailor->delete();

                $output = [
                    'success' => true,
                    'msg' => __('messages.success'),
                ];
            } catch (\Exception $e) {
                \Log::emergency('File:' . $e->getFile() . 'Line:' . $e->getLine() . 'Message:' . $e->getMessage());

                $output = [
                    'success' => false,
                    'msg' => __('messages.something_went_wrong'),
                ];
            }

            return response()->json($output);
        }
    }

    public function showTailorMaster($id)
    {
        if (!auth()->user()->can('user.view')) {
            abort(403, 'Unauthorized action.');
        }

        $business_id = request()->session()->get('user.business_id');

        $tailor = TailorMasterList::whereHas('user', function ($query) use ($business_id) {
            $query->where('business_id', $business_id);
        })->findOrFail($id);

        return view('tailor_master.show')->with(compact('tailor'));
    }


    public function getPayTailorMasterDue($id)
    {
        if (!auth()->user()->can('user.update')) {
            abort(403, 'Unauthorized action.');
        }

        if (request()->ajax()) {
            $business_id = request()->session()->get('user.business_id');

            $tailor = TailorMasterList::whereHas('user', function ($query) use ($business_id) {
                $query->where('business_id', $business_id);
            })->findOrFail($id);

            $payment_line = new \App\TransactionPayment();
            $payment_line->amount = $tailor->total_wages_due;
            $payment_line->method = 'cash';
            $payment_line->paid_on = \Carbon::now()->toDateTimeString();

            $transactionUtil = new \App\Utils\TransactionUtil();
            $payment_types = $transactionUtil->payment_types(null, false, $business_id);

            //Accounts
            $accounts = $this->moduleUtil->accountsDropdown($business_id, true);

            return view('tailor_master.pay_due_modal')
                ->with(compact('tailor', 'payment_types', 'payment_line', 'accounts'));
        }
    }

    public function postPayTailorMasterDue(Request $request)
    {
        if (!auth()->user()->can('user.update')) {
            abort(403, 'Unauthorized action.');
        }

        try {
            DB::beginTransaction();

            $business_id = request()->session()->get('user.business_id');
            $tailor_id = $request->input('tailor_id');

            $tailor = TailorMasterList::whereHas('user', function ($query) use ($business_id) {
                $query->where('business_id', $business_id);
            })->findOrFail($tailor_id);

            $transactionUtil = new \App\Utils\TransactionUtil();

            $inputs = $request->only([
                'amount',
                'method',
                'note',
                'card_number',
                'card_holder_name',
                'card_transaction_number',
                'card_type',
                'card_month',
                'card_year',
                'card_security',
                'cheque_number',
                'bank_account_number'
            ]);
            $inputs['paid_on'] = $transactionUtil->uf_date($request->input('paid_on'), true);
            $inputs['amount'] = $transactionUtil->num_uf($inputs['amount']);
            $inputs['created_by'] = auth()->user()->id;
            $inputs['business_id'] = $business_id;

            if ($inputs['method'] == 'custom_pay_1') {
                $inputs['transaction_no'] = $request->input('transaction_no_1');
            } elseif ($inputs['method'] == 'custom_pay_2') {
                $inputs['transaction_no'] = $request->input('transaction_no_2');
            } elseif ($inputs['method'] == 'custom_pay_3') {
                $inputs['transaction_no'] = $request->input('transaction_no_3');
            }

            if (!empty($request->input('account_id'))) {
                $inputs['account_id'] = $request->input('account_id');
            }

            $prefix_type = 'tailor_payment';
            $ref_count = $transactionUtil->setAndGetReferenceCount($prefix_type);
            $inputs['payment_ref_no'] = $transactionUtil->generateReferenceNumber($prefix_type, $ref_count);

            $inputs['document'] = $transactionUtil->uploadFile($request, 'document', 'documents');

            // Set payment_for to user_id to identify who was paid
            $inputs['payment_for'] = $tailor->user_id;

            // It's a payment to tailor, so it acts like an expense. We will flag it as expense_payment.
            $inputs['transaction_type'] = 'expense'; // Mocking so account transaction can be handled as debit. Wait, TransactionPaymentAdded may not handle if transaction_id is missing, let's pass it anyway.

            $tp = \App\TransactionPayment::create($inputs);

            // Update tailor master list balances
            $tailor->total_wages_paid += $inputs['amount'];
            $tailor->total_wages_due -= $inputs['amount'];
            $tailor->save();

            $inputs['is_tailoring'] = 1;

            // event to update account balance
            event(new \App\Events\TransactionPaymentAdded($tp, $inputs));

            DB::commit();

            $output = [
                'success' => true,
                'msg' => __('messages.success'),
            ];
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::emergency('File:' . $e->getFile() . 'Line:' . $e->getLine() . 'Message:' . $e->getMessage());

            $output = [
                'success' => false,
                'msg' => __('messages.something_went_wrong'),
            ];
        }

        return redirect()->back()->with(['status' => $output]);
    }
}
