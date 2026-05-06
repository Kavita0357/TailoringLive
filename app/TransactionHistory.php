<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\User;

class TransactionHistory extends Model
{
    use HasFactory;

    protected $table = 'transfer_sms_balance_history';

    protected $fillable = [
        'transferred_by',
        'transferred_to',
        'amount',
    ];

    public function transferredByUser()
    {
        return $this->belongsTo(User::class, 'transferred_by');
    }

    public function transferredToUser()
    {
        return $this->belongsTo(User::class, 'transferred_to');
    }
}
