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

    public static function recalculateTailorMasterStats($transactionId, $tailorMasterUserId)
    {
        $tailorMaster = self::where('user_id', $tailorMasterUserId)->first();

        if (!$tailorMaster) {
            return;
        }

        $sell_lines = DB::table('transaction_sell_lines as tsl')
            ->leftJoin('cloths as c', 'tsl.cloth_id', '=', 'c.id')
            ->where('tsl.tailoring_master_id', $tailorMasterUserId)
            ->where('tsl.transaction_id', $transactionId)
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
        $total_wages_paid = 0;

        $total_completed_orders = 0;

        foreach ($sell_lines as $line) {

            $completed = (float) $line->completed_quantity;

            $quantity = !empty($line->assigned_quantity)
                ? (float) $line->assigned_quantity
                : (float) $line->quantity;

            $wages = (float) ($line->wages ?? 0);

            $total_wages += ($quantity * $wages);

            $total_completed += $completed;

            if ($completed > 0) {
                $total_wages_paid += ($completed * $wages);
            }

            // Assigned qty == completed qty
            if ($quantity > 0 && $completed == $quantity) {
                $total_completed_orders = 1;
            }
        }

        // 1 = completed, 0 = not completed
        // $total_completed_orders = $all_completed ? 1 : 0;

        $tailorMaster->total_completed_orders = $total_completed_orders;
        $tailorMaster->total_wages = $total_wages;
        $tailorMaster->total_wages_paid = $total_wages_paid;

        $tailorMaster->total_wages_due = max(
            0,
            $total_wages - $total_wages_paid
        );

        $tailorMaster->save();
    }
}
