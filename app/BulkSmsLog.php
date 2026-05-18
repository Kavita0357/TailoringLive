<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BulkSmsLog extends Model
{
    protected $table = 'bulk_sms_logs';

    protected $fillable = [
        'sms_log_id',
        'business_id',
        'created_by',
        'sender_id',
        'recipient_number',
        'message',
        'status',
        'api_response',
        'cost',
        'sent_at',
    ];

    protected $casts = [
        'api_response' => 'array',
        'sent_at' => 'datetime',
        'cost' => 'decimal:2',
    ];

    public function smsLog()
    {
        return $this->belongsTo(SmsLog::class, 'sms_log_id');
    }
}
