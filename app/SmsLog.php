<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SmsLog extends Model
{
    protected $fillable = [
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

    public function business()
    {
        return $this->belongsTo(Business::class);
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}