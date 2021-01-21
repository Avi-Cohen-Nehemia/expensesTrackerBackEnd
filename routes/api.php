<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Transactions;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// get all transactions
Route::get("/transactions", [Transactions::class, "index"]);

// get balance
Route::get("/transactions/balance", [Transactions::class, "getBalance"]);

// create a new transaction
Route::post("/transactions", [Transactions::class, "store"]);

// show a specific transaction
Route::get("/transactions/{transaction}", [Transactions::class, "show"]);

// update a specific transaction
Route::put("/transactions/{transaction}", [Transactions::class, "update"]);

// delete a specific transaction
Route::delete("/transactions/{transaction}", [Transactions::class, "destroy"]);
