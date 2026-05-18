<?php

namespace App\Console\Commands;

use App\Business;
use App\SmsLog;
use App\BulkSmsLog;
use App\SmsSchedule;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class SendScheduledSms extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pos:sendScheduledSms';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send scheduled SMS messages that are due.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $lock = Cache::lock('pos_send_sms_lock', 300); // 5 min lock

        if (!$lock->get()) {
            $this->info('Already running...');
            return 0;
        }

        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '512M');
        \Log::info('Starting scheduled SMS sending process.');
        $schedules = SmsSchedule::where('status', 'Scheduled')
            ->where('send_at', '<=', now())
            ->limit(100)
            ->get();

        \Log::info('Found ' . $schedules->count() . ' scheduled SMS messages to process.');
        if ($schedules->isEmpty()) {
            return 0;
        }

        foreach ($schedules as $schedule) {
            try {
                if (empty($schedule->numbers)) {
                    $schedule->status = 'Failed';
                    $schedule->api_response = json_encode(['error_message' => 'No recipient numbers available']);
                    $schedule->processed_at = now();
                    $schedule->save();
                    continue;
                }

                $numbers = array_filter(array_map('trim', explode(',', $schedule->numbers)));

                $sms_count = count($numbers);
                $cost_per_sms = 0.3;
                $estimated_cost = $sms_count * $cost_per_sms;

                $current_business = Business::find($schedule->business_id);

                if ($current_business->remaining_sms_balance < $estimated_cost) {
                    $schedule->api_response = json_encode(['error_message' => 'Insufficient SMS balance.']);
                    $schedule->processed_at = now();
                    $schedule->save();
                    continue;
                }

                $api_key = "TFHRkrCuNgL0JuqotRzy";

                $response = Http::post('http://bulksmsbd.net/api/smsapi', [
                    'api_key' => $api_key,
                    'type' => 'text',
                    'number' => $schedule->numbers,
                    'senderid' => $schedule->sender_id,
                    'message' => $schedule->message,
                ]);

                $api_res = $response->json();

                if (empty($api_res['success_message'])) {
                    $smsLog = SmsLog::create([
                        'business_id' => $schedule->business_id,
                        'created_by' => $schedule->business_id,
                        'sender_id' => $schedule->sender_id,
                        'recipient_number' => $schedule->numbers,
                        'message' => $schedule->message,
                        'sms_type' => $sms_count === 1 ? 'Single' : 'Group',
                        'status' => 'failed',
                        'api_response' => $api_res,
                        'cost' => $cost_per_sms,
                        'sent_at' => now(),
                    ]);

                    if ($sms_count > 1) {
                        foreach ($numbers as $number) {
                            BulkSmsLog::create([
                                'sms_log_id' => $smsLog->id,
                                'business_id' => $schedule->business_id,
                                'created_by' => $schedule->business_id,
                                'sender_id' => $schedule->sender_id,
                                'recipient_number' => $number,
                                'message' => $schedule->message,
                                'status' => 'failed',
                                'api_response' => $api_res,
                                'cost' => $cost_per_sms,
                                'sent_at' => now(),
                            ]);
                        }
                    }

                    $schedule->api_response = json_encode(['error_message' => 'SMS sending failed']);
                    $schedule->processed_at = now();
                    $schedule->save();
                    continue;
                }

                preg_match('/(\d+)$/', $api_res['success_message'], $matches);
                $sent_count = isset($matches[1]) ? (int) $matches[1] : 0;

                $total_cost = $sent_count * $cost_per_sms;

                Business::where('id', $schedule->business_id)
                    ->decrement('remaining_sms_balance', $total_cost);

                // For group sends create a summary and per-recipient bulk logs
                if ($sms_count > 1) {
                    $smsLog = SmsLog::create([
                        'business_id' => $schedule->business_id,
                        'created_by' => $schedule->business_id,
                        'sender_id' => $schedule->sender_id,
                        'recipient_number' => $schedule->numbers,
                        'message' => $schedule->message,
                        'sms_type' => 'Group',
                        'status' => 'Sent',
                        'api_response' => $api_res,
                        'cost' => $cost_per_sms * $sms_count,
                        'sent_at' => now(),
                    ]);

                    foreach ($numbers as $number) {
                        BulkSmsLog::create([
                            'sms_log_id' => $smsLog->id,
                            'business_id' => $schedule->business_id,
                            'created_by' => $schedule->business_id,
                            'sender_id' => $schedule->sender_id,
                            'recipient_number' => $number,
                            'message' => $schedule->message,
                            'status' => 'Sent',
                            'api_response' => $api_res,
                            'cost' => $cost_per_sms,
                            'sent_at' => now(),
                        ]);
                    }
                } else {
                    // single recipient
                    SmsLog::create([
                        'business_id' => $schedule->business_id,
                        'created_by' => $schedule->business_id,
                        'sender_id' => $schedule->sender_id,
                        'recipient_number' => $numbers[0] ?? $schedule->numbers,
                        'message' => $schedule->message,
                        'sms_type' => 'Single',
                        'status' => 'Sent',
                        'api_response' => $api_res,
                        'cost' => $cost_per_sms,
                        'sent_at' => now(),
                    ]);
                }

                $schedule->status = 'Sent';
                $schedule->api_response = null;
                $schedule->processed_at = now();
                $schedule->save();

            } catch (\Exception $e) {
                $schedule->status = 'Failed';
                $schedule->api_response = json_encode([
                    'error_message' => $e->getMessage(),
                ]);
                $schedule->processed_at = now();
                $schedule->save();
                \Log::emergency('Scheduled SMS send failed: ' . $e->getMessage());
            }
        }
        return 0;
    }
}
