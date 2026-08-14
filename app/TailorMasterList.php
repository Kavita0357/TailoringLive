<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TailorMasterList extends Model
{
    protected $table = 'tailor_master_list';

    protected $guarded = ['id'];

    public $timestamps = true;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public static function recalculateTailorMasterStats($tailorMasterUserId)
    {
        if (empty($tailorMasterUserId)) {
            return;
        }

        $tailorMaster = self::where('user_id', $tailorMasterUserId)->first();
        if (!$tailorMaster) {
            return;
        }

        $sell_lines = \DB::table('transaction_sell_lines')
            ->join('transactions', 'transaction_sell_lines.transaction_id', '=', 'transactions.id')
            ->leftJoin('cloths', 'transaction_sell_lines.cloth_id', '=', 'cloths.id')
            ->where('transaction_sell_lines.tailoring_master_id', $tailorMasterUserId)
            ->where('transactions.type', 'order')
            ->where('transactions.status', '!=', 'draft')
            ->select([
                'transaction_sell_lines.completed_quantity',
                'transaction_sell_lines.assigned_quantity',
                'transaction_sell_lines.quantity',
                'cloths.wages'
            ])
            ->get();

        $total_completed = 0;
        $total_wages = 0;

        foreach ($sell_lines as $line) {
            $completed = (int)$line->completed_quantity;
            $quantity = !empty($line->assigned_quantity) ? $line->assigned_quantity : $line->quantity;
            $wages = (float)($line->wages ?? 0);

            $total_completed += $completed;
            $total_wages += ($quantity * $wages);
        }

        $tailorMaster->total_completed_orders = $total_completed;
        $tailorMaster->total_wages = $total_wages;
        $tailorMaster->total_wages_due = max(0, $total_wages - $tailorMaster->total_wages_paid);
        $tailorMaster->save();
    }
}
