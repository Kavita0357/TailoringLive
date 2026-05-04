<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


use App\Http\Controllers\TransactionHistoryController;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Transaction History Store API
Route::middleware('auth:api')->post('/transaction-history', [TransactionHistoryController::class, 'store']);
