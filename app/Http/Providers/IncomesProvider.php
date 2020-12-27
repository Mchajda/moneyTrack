<?php


namespace App\Http\Providers;


use App\Http\Providers\Interfaces\IncomesProviderInterface;

class IncomesProvider implements IncomesProviderInterface
{

    public function getAll($user_id)
    {
        // TODO: Implement getAll() method.
    }

    public function getAllByCategory($user_id, $category, $month)
    {
        // TODO: Implement getAllByCategory() method.
    }

    public function getAllByMonth($user_id, $month)
    {
        // TODO: Implement getAllByMonth() method.
    }
}
