<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;

class TailorMasterList extends Model
{
    protected $table = 'tailor_master_list';

    protected $guarded = ['id'];

    public $timestamps = true;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public static function recalculateTailorMasterStats($transactionId, $tailorMasterUserId = null)
    {
        $userId = $tailorMasterUserId !== null ? $tailorMasterUserId : $transactionId;
        $tailorMaster = self::where('user_id', $userId)->first();

        if (!$tailorMaster) {
            return;
        }

        $sell_lines = DB::table('transaction_sell_lines as tsl')
            ->leftJoin('cloths as c', 'tsl.cloth_id', '=', 'c.id')
            ->where('tsl.tailoring_master_id', $userId)
            // ->where('tsl.transaction_id', $transactionId)
            ->select([
                'tsl.id',
                'tsl.transaction_id',
                'tsl.cloth_id',
                'tsl.completed_quantity',
                'tsl.assigned_quantity',
                'tsl.quantity',
                'c.cloth_name',
                'c.wages',
            ])
            ->get();

        $total_completed = 0;
        $total_wages = 0;

        foreach ($sell_lines as $line) {

            $completed = (float) ($line->completed_quantity ?? 0);

            $quantity = !empty($line->assigned_quantity)
                ? (float) $line->assigned_quantity
                : (float) $line->quantity;

            $wages = (float) ($line->wages ?? 0);

            $total_completed += $completed;

            if ($completed > 0) {
                $total_wages += ($completed * $wages);
            }
        }

        $tailorMaster->total_completed_orders = (int) $total_completed;
        $tailorMaster->total_wages = $total_wages;

        $tailorMaster->total_wages_due = max(
            0,
            $total_wages - $tailorMaster->total_wages_paid
        );

        $tailorMaster->save();
    }
}
