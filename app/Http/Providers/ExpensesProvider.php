<?php


namespace App\Http\Providers;


use App\Http\Providers\Interfaces\ExpensesProviderInterface;
use App\Models\Expense;

class ExpensesProvider implements ExpensesProviderInterface
{

    public function getAll($user_id)
    {
        return Expense::where('user_id', $user_id)->orderBy('date', 'DESC')->orderBy('created_at', 'DESC')->get();
    }
}
