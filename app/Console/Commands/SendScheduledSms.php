<?php

namespace App\Console\Commands;

use App\SmsSchedule;
use Illuminate\Console\Command;
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
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '512M');

        $schedules = SmsSchedule::where('status', 'pending')
            ->where('send_at', '<=', now())
            ->get();

        if ($schedules->isEmpty()) {
            return 0;
        }

        foreach ($schedules as $schedule) {
            try {
                if (empty($schedule->numbers)) {
                    $schedule->status = 'failed';
                    $schedule->api_response = json_encode(['error_message' => 'No recipient numbers available']);
                    $schedule->processed_at = now();
                    $schedule->save();
                    continue;
                }

                $response = Http::post('http://bulksmsbd.net/api/smsapi', [
                    'api_key' => 'TFHRkrCuNgL0JuqotRzy',
                    'type' => 'text',
                    'number' => $schedule->numbers,
                    'senderid' => $schedule->sender_id,
                    'message' => $schedule->message,
                ]);

                $api_res = $response->json();

                $schedule->api_response = json_encode($api_res);
                $schedule->processed_at = now();
                $schedule->status = ! empty($api_res['success_message']) ? 'sent' : 'failed';
                $schedule->save();
            } catch (\Exception $e) {
                $schedule->status = 'failed';
                $schedule->api_response = json_encode([
                    'error_message' => $e->getMessage(),
                ]);
                $schedule->processed_at = now();
                $schedule->save();
                \Log::emergency('Scheduled SMS send failed: '.$e->getMessage());
            }
        }

        return 0;
    }
}
