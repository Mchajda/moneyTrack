<?php


namespace App\Http\Providers;


use App\Http\Providers\Interfaces\ExpensesProviderInterface;
use App\Models\Expense;

class ExpensesProvider implements ExpensesProviderInterface
{

    public function getAll($user_id)
    {
        return Expense::where('user_id', $user_id)->where('direction', 'expense')->orderBy('date', 'DESC')->orderBy('created_at', 'DESC')->get();
    }

    public function getAllByCategory($user_id, $category, $month)
    {
        return Expense::where('user_id', $user_id)->where('direction', 'expense')->where('category', $category)->whereMonth('date', $month)->orderBy('date', 'DESC')->orderBy('created_at', 'DESC')->get();
    }

    public function getAllByMonth($user_id, $month)
    {
        // TODO: Implement getAllByMonth() method.
    }
}
