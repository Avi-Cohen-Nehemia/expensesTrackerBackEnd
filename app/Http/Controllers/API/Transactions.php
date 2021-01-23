<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Transaction;
use App\Http\Requests\API\TransactionRequest;

class Transactions extends Controller
{
    // public function getBalance()
    // {
    //     $balance = Incomes::totalIncome() - Expenses::totalExpense();

    //     $format = new NumberFormatter( 'en_GB', NumberFormatter::CURRENCY );
    //     $formattedBalance = $format->formatCurrency($balance, "GBP");

    //     return response()->json(['data' => [
    //         'balance' => $formattedBalance,
    //     ]]);
    // }

    public function index()
    {
        return Transaction::all();
    }

    public static function getBalance() : float
    {
        $collection = collect(Transaction::all());

        $total = $collection->reduce(function ($acc, $value) {
            return $acc + $value->amount;
        }, 0);

        return $total;
    }

    public function store(TransactionRequest $request)
    {   
        // take all the details in the submitted request and store them into a variable.
        $data = $request->all();
        // create and return a new Transaction with the the variable we created.
        return Transaction::create($data);
    }

    // the Transaction gets passed in for us using Route Model Binding
    public function show(Transaction $transaction)
    {
        return $transaction;
    }

    public function update(TransactionRequest $request, Transaction $transaction)
    {
        // get the request data
        $data = $request->all();

        // update the Transaction using the fill method
        // then save it to the database
        $transaction->fill($data)->save();
        
        // return the updated version
        return $transaction;
    }

    public function destroy(Transaction $transaction)
    {
        // delete the Transaction from the DB
        $transaction->delete();
        
        // use a 204 code as there is no content in the response
        return response(null, 204);
    }
}