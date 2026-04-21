<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SmsSchedule extends Model
{
    protected $table = 'sms_schedules';

    protected $fillable = [
        'business_id',
        'created_by',
        'sender_id',
        'recipients',
        'numbers',
        'message',
        'schedule_type',
        'send_at',
        'status',
        'api_response',
        'processed_at',
    ];

    protected $casts = [
        'recipients' => 'array',
        'send_at' => 'datetime',
        'processed_at' => 'datetime',
    ];
}
