<?php


namespace App\Http\Providers\Interfaces;


interface IncomesProviderInterface
{
    public function getAll($user_id);
    public function getAllByCategory($user_id, $category, $month);
    public function getAllByMonth($user_id, $month);
}
