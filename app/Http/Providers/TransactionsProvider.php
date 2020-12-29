<?php


namespace App\Http\Providers;


use App\Http\Providers\Interfaces\TransactionsProviderInterface;
use App\Models\Expense;

class TransactionsProvider implements TransactionsProviderInterface
{

    public function getAllExpenses($user_id)
    {
        return Expense::where('user_id', $user_id)->where('direction', 'expense')->orderBy('date', 'DESC')->orderBy('created_at', 'DESC')->get();
    }

    public function getAllExpensesByCategory($user_id, $category, $month)
    {
        return Expense::where('user_id', $user_id)->where('direction', 'expense')->where('category_name', $category)->whereMonth('date', $month)->orderBy('date', 'DESC')->orderBy('created_at', 'DESC')->get();
    }

    public function getAllExpensesByMonth($user_id, $month)
    {
        // TODO: Implement getAllByMonth() method.
    }

    public function getAllIncomes($user_id)
    {
        return Expense::where('user_id', $user_id)->where('direction', 'income')->orderBy('date', 'DESC')->orderBy('created_at', 'DESC')->get();
    }

    public function getAllIncomesByCategory($user_id, $category, $month)
    {
        return Expense::where('user_id', $user_id)->where('direction', 'income')->where('category_name', $category)->whereMonth('date', $month)->orderBy('date', 'DESC')->orderBy('created_at', 'DESC')->get();
    }

    public function getAllIncomesByMonth($user_id, $month)
    {
        // TODO: Implement getAllByMonth() method.
    }

    public function getAllByMonth($user_id, $month)
    {
        return Expense::where('user_id', $user_id)->whereMonth('date', $month)->orderBy('date', 'DESC')->orderBy('created_at', 'DESC')->get();
    }
}
