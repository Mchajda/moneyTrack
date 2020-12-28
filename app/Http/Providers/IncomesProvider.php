<?php


namespace App\Http\Providers;


use App\Http\Providers\Interfaces\IncomesProviderInterface;
use App\Models\Expense;

class IncomesProvider implements IncomesProviderInterface
{

    public function getAll($user_id)
    {
        return Expense::where('user_id', $user_id)->where('direction', 'income')->orderBy('date', 'DESC')->orderBy('created_at', 'DESC')->get();
    }

    public function getAllByCategory($user_id, $category, $month)
    {
        return Expense::where('user_id', $user_id)->where('direction', 'income')->where('category', $category)->whereMonth('date', $month)->get();
    }

    public function getAllByMonth($user_id, $month)
    {
        // TODO: Implement getAllByMonth() method.
    }
}
