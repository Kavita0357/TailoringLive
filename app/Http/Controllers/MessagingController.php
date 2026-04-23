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

            return view('messaging.create')->with(compact('customers', 'suppliers', 'sms_balance', 'is_superadmin'));
        }
    }

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
                    $numbers[] = $recipient;
                }
            }
        }

        $numbers = implode(',', array_unique($numbers));

        if (empty($numbers)) {
            return response()->json([
                'success' => false,
                'msg' => 'No recipient numbers found.',
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
    }
}