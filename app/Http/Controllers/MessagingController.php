<?php

namespace App\Http\Controllers;

use App\Contact;
use App\SmsSchedule;
use App\Business;
use App\Utils\ModuleUtil;
use App\Utils\ContactUtil;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MessagingController extends Controller
{
    protected $moduleUtil;
    protected $contactUtil;
    protected $enabled_modules;

    /**
     * Constructor
     */

    public function __construct(ModuleUtil $moduleUtil, ContactUtil $contactUtil)
    {
        $this->contactUtil = $contactUtil;
        $this->middleware(function ($request, $next) use ($moduleUtil) {
            $this->moduleUtil = $moduleUtil;
            $this->enabled_modules = session('business.enabled_modules') ?? [];
            return $next($request);
        });
    }

    /**
     * Show Bulk SMS Page
     */
    public function create()
    {
        $business_id = request()->session()->get('user.business_id');

        $url = "http://bulksmsbd.net/api/getBalanceApi";

        $sms_balance_data = Http::asForm()->post($url, [
            'api_key' => 'TFHRkrCuNgL0JuqotRzy',
        ]);

        $sms_balance = $sms_balance_data->json();

        // Subscription check (same as your pattern)
        if (!$this->moduleUtil->isSubscribed($business_id)) {
            return $this->moduleUtil->expiredResponse();
        }

        if (!auth()->user()->can('supplier.view') && !auth()->user()->can('supplier.view_own')) {
            abort(403, 'Unauthorized action.');
        }

        $is_superadmin = auth()->user()->can('superadmin');

        if ($is_superadmin) {
            $businesses = Business::where('id', '!=', $business_id)->pluck('name', 'id');

            return view('messaging.create')->with(compact('sms_balance', 'is_superadmin', 'businesses'));
        } else {
            $customers = Contact::customersForMessaging($business_id);
            $suppliers = Contact::customersForMessaging($business_id, 'supplier');
            $current_business = Business::findOrFail($business_id);
            $sms_balance['balance'] = $current_business->remaining_sms_balance ?? 0;
            return view('messaging.create')->with(compact('customers', 'suppliers', 'sms_balance', 'is_superadmin'));
        }
    }

    /* public function sendSms(Request $request)
    {
        $request->validate([
            'sender_id' => 'required',
            'recipients' => 'required',
            'message' => 'required',
            'schedule_type' => 'required',
            'schedule_time' => 'required_if:schedule_type,later|date',
        ]);

        $api_key = "TFHRkrCuNgL0JuqotRzy";

        $recipients = (array) $request->recipients;
        $numbers = [];

        $is_superadmin = auth()->user()->can('superadmin');

        foreach ($recipients as $recipient) {

            // ✅ Superadmin: All businesses
            if ($is_superadmin && $recipient === 'all_businesses') {
                $nums = Contact::whereIn('type', ['customer', 'supplier'])
                    ->pluck('mobile')
                    ->filter()
                    ->toArray();

                $numbers = array_merge($numbers, $nums);
            }

            // ✅ Superadmin: Single business
            elseif ($is_superadmin && preg_match('/^business_(\d+)$/', $recipient, $matches)) {
                $biz_id = $matches[1];

                $nums = Contact::where('business_id', $biz_id)
                    ->whereIn('type', ['customer', 'supplier'])
                    ->pluck('mobile')
                    ->filter()
                    ->toArray();

                $numbers = array_merge($numbers, $nums);
            }

            // ✅ Normal user: all customers
            elseif ($recipient === 'all_customers') {
                $nums = Contact::where('type', 'customer')
                    ->pluck('mobile')
                    ->filter()
                    ->toArray();

                $numbers = array_merge($numbers, $nums);
            }

            // ✅ Normal user: all suppliers
            elseif ($recipient === 'all_suppliers') {
                $nums = Contact::where('type', 'supplier')
                    ->pluck('mobile')
                    ->filter()
                    ->toArray();

                $numbers = array_merge($numbers, $nums);
            }

            // ✅ Individual numbers
            else {
                if (!empty($recipient)) {
                    $cleanNumber = preg_replace('/[\s\+\-]/', '', $recipient);

                    if (!preg_match('/^\+88/', $recipient) && !preg_match('/^88/', $cleanNumber)) {
                        if (preg_match('/^01[3-9]/', $cleanNumber)) {
                            $cleanNumber = '88' . $cleanNumber;
                        }
                    }

                    if (preg_match('/^(\+88|88)?01[3-9]\d{8}$/', $cleanNumber)) {
                        $finalNumber = preg_replace('/^(\+88|88)/', '', $cleanNumber);
                        $numbers[] = $finalNumber;
                    }
                }
            }
        }

        $numbers = implode(',', array_unique($numbers));

        if (empty($numbers)) {
            return response()->json([
                'success' => false,
                'msg' => 'No recipient numbers found.',
                'data' => $numbers
            ], 422);
        }

        if ($request->schedule_type === 'later') {
            $sendAt = Carbon::parse($request->schedule_time);

            if ($sendAt->lte(now())) {
                return response()->json([
                    'success' => false,
                    'msg' => 'Schedule time must be in the future.',
                ], 422);
            }

            SmsSchedule::create([
                'business_id' => $request->session()->get('user.business_id'),
                'created_by' => auth()->id(),
                'sender_id' => $request->sender_id,
                'recipients' => $recipients,
                'numbers' => $numbers,
                'message' => $request->message,
                'schedule_type' => 'later',
                'send_at' => $sendAt,
                'status' => 'pending',
            ]);

            return response()->json([
                'success' => true,
                'msg' => 'SMS has been scheduled successfully.',
            ]);
        }

        $response = Http::post('http://bulksmsbd.net/api/smsapi', [
            'api_key' => $api_key,
            'type' => 'text',
            'number' => $numbers,
            'senderid' => $request->sender_id,
            'message' => $request->message,
        ]);

        $api_res = $response->json();

        if (empty($api_res['success_message'])) {
            return response()->json([
                'success' => false,
                'msg' => $api_res['error_message'] ?? __('messages.something_went_wrong'),
                'data' => $request->all(),
                'numbers' => $numbers
            ]);
        }

        return response()->json([
            'success' => true,
            'api_response' => $api_res,
            'data' => $request->all(),
            'numbers' => $numbers
        ]);
    } */

    public function sendSms(Request $request)
    {
        $request->validate([
            'sender_id' => 'required',
            'recipients' => 'required',
            'message' => 'required',
            'schedule_type' => 'required',
            'schedule_time' => 'required_if:schedule_type,later|date',
        ]);

        $api_key = "TFHRkrCuNgL0JuqotRzy";

        $recipients = (array) $request->recipients;
        $numbers = [];

        $business_id = request()->session()->get('user.business_id');

        $is_superadmin = auth()->user()->can('superadmin');

        foreach ($recipients as $recipient) {

            if ($is_superadmin && $recipient === 'all_businesses') {
                $nums = Contact::whereIn('type', ['customer', 'supplier'])
                    ->pluck('mobile')
                    ->filter()
                    ->toArray();

                $numbers = array_merge($numbers, $nums);
            } elseif ($is_superadmin && preg_match('/^business_(\d+)$/', $recipient, $matches)) {
                $biz_id = $matches[1];

                $nums = Contact::where('business_id', $biz_id)
                    ->whereIn('type', ['customer', 'supplier'])
                    ->pluck('mobile')
                    ->filter()
                    ->toArray();

                $numbers = array_merge($numbers, $nums);
            } elseif ($recipient === 'all_customers') {
                $nums = Contact::where('business_id', $business_id)
                    ->whereIn('type', ['customer'])
                    ->pluck('mobile')
                    ->filter()
                    ->toArray();

                $numbers = array_merge($numbers, $nums);
            } elseif ($recipient === 'all_suppliers') {
                $nums = Contact::where('business_id', $business_id)
                    ->whereIn('type', ['supplier'])
                    ->pluck('mobile')
                    ->filter()
                    ->toArray();

                $numbers = array_merge($numbers, $nums);
            } else {
                if (!empty($recipient)) {
                    $cleanNumber = preg_replace('/[\s\+\-]/', '', $recipient);

                    if (preg_match('/^1[3-9]\d{8}$/', $cleanNumber)) {
                        $cleanNumber = '0' . $cleanNumber;
                    }

                    if (!preg_match('/^(\+88|88)/', $cleanNumber)) {
                        if (preg_match('/^01[3-9]/', $cleanNumber)) {
                            $cleanNumber = '88' . $cleanNumber;
                        }
                    }

                    if (preg_match('/^(\+88|88)?01[3-9]\d{8}$/', $cleanNumber)) {
                        $finalNumber = preg_replace('/^(\+88|88)/', '', $cleanNumber);
                        $numbers[] = $finalNumber;
                    }
                }
            }
        }

        $numbersArray = array_unique($numbers);

        if (empty($numbersArray)) {
            return response()->json([
                'success' => false,
                'msg' => 'No recipient numbers found.',
            ], 422);
        }

        $sms_count = count($numbersArray);

        $cost_per_sms = 0.3;
        $total_cost = $sms_count * $cost_per_sms;

        $business_id = $request->session()->get('user.business_id');
        $current_business = Business::find($business_id);

        if ($current_business->remaining_sms_balance < $total_cost) {
            return response()->json([
                'success' => false,
                'msg' => 'Insufficient SMS balance.',
                'total_cost' => $total_cost,
                'numbers' => $numbersArray,

            ], 422);
        }

        $numbersString = implode(',', $numbersArray);

        if ($request->schedule_type === 'later') {

            $sendAt = Carbon::parse($request->schedule_time);

            if ($sendAt->lte(now())) {
                return response()->json([
                    'success' => false,
                    'msg' => 'Schedule time must be in the future.',
                ], 422);
            }

            SmsSchedule::create([
                'business_id' => $business_id,
                'created_by' => auth()->id(),
                'sender_id' => $request->sender_id,
                'recipients' => $recipients,
                'numbers' => $numbersString,
                'message' => $request->message,
                'schedule_type' => 'later',
                'send_at' => $sendAt,
                'status' => 'pending',
                'cost' => $total_cost
            ]);

            return response()->json([
                'success' => true,
                'msg' => 'SMS has been scheduled successfully.',
            ]);
        }

        DB::beginTransaction();

        try {

            $updated = Business::where('id', $business_id)
                ->where('remaining_sms_balance', '>=', $total_cost)
                ->decrement('remaining_sms_balance', $total_cost);

            if (!$updated) {
                DB::rollBack();
                return response()->json([
                    'success' => false,
                    'msg' => 'Insufficient SMS balance.',
                    'total_cost' => $total_cost
                ], 422);
            }

            $response = Http::post('http://bulksmsbd.net/api/smsapi', [
                'api_key' => $api_key,
                'type' => 'text',
                'number' => $numbersString,
                'senderid' => $request->sender_id,
                'message' => $request->message,
            ]);

            $api_res = $response->json();

            if (empty($api_res['success_message'])) {
                DB::rollBack();

                return response()->json([
                    'success' => false,
                    'msg' => $api_res['error_message'] ?? 'SMS sending failed',
                ]);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'msg' => 'SMS sent successfully',
                'total_cost' => $total_cost,
                'remaining_balance' => Business::find($business_id)->remaining_sms_balance,
                'api_response' => $api_res,
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'msg' => $e->getMessage(),
            ]);
        }
    }
}
