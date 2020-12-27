<?php


namespace App\Http\Providers\Interfaces;


interface ExpensesProviderInterface
{
    public function getAll($user_id);
}
