<?php


namespace App\Http\Providers\Interfaces;


interface TransactionsProviderInterface
{
    public function getAllExpenses($user_id);
    public function getAllExpensesByCategory($user_id, $category, $month);
    public function getAllExpensesByMonth($user_id, $month);

    public function getAllIncomes($user_id);
    public function getAllIncomesByCategory($user_id, $category, $month);
    public function getAllIncomesByMonth($user_id, $month);

    public function getAllByMonth($user_id, $month);
}
