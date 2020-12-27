<?php


namespace App\Http\Providers\Interfaces;


interface ExpensesProviderInterface
{
    public function getAll($user_id);
    public function getAllByCategory($user_id, $category, $month);
}
