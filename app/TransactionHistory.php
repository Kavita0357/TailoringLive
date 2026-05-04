<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionHistory extends Model
{
    use HasFactory;

    protected $table = 'transfer_sms_balance_history';

    protected $fillable = [
        'transferred_by',
        'transferred_to',
        'amount',
    ];
}
