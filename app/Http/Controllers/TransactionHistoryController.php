<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TransactionHistory;
use Illuminate\Support\Facades\Auth;

class TransactionHistoryController extends Controller
{
    /**
     * Store a newly created transaction history in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'transferred_by' => 'required|integer|exists:users,id',
            'transferred_to' => 'required|integer|exists:users,id',
            'amount' => 'required|numeric|min:0.01',
        ]);

        // Optionally, check if the user is super admin here
        // if (!Auth::user() || !Auth::user()->hasRole('Super Admin')) {
        //     return response()->json(['error' => 'Unauthorized'], 403);
        // }

        $transaction = TransactionHistory::create([
            'transferred_by' => $request->transferred_by,
            'transferred_to' => $request->transferred_to,
            'amount' => $request->amount,
        ]);

        return response()->json(['success' => true, 'transaction' => $transaction], 201);
    }
}
