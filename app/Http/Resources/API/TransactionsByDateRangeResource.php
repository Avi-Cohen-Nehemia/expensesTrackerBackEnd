<?php

namespace App\Http\Resources\API;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\API\TransactionResource;
use App\Utility\UserFunds;

class TransactionsByDateRangeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $transactions = $this->map(function ($transaction) {
            return new TransactionResource($transaction);
        });

        $balance = UserFunds::calculateBalance($transactions);
        $totalIncome = UserFunds::calculateIncome($transactions);
        $totalExpense = UserFunds::calculateExpense($transactions);
        $totalExpenseByCategory = UserFunds::calculateByCategory($transactions);

        return [
            "balance" => floatval($balance),
            "balance_with_currency" => "£{$balance}",
            "total_income" => floatval($totalIncome),
            "total_income_with_currency" => "£{$totalIncome}",
            "total_expense" => floatval($totalExpense),
            "total_expense_with_currency" => "£{$totalExpense}",
            "total_expense_by_category" => $totalExpenseByCategory,
            "transactions" => $transactions,
        ];
    }
}
