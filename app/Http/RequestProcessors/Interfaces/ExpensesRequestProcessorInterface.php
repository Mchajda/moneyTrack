<?php


namespace App\Http\RequestProcessors\Interfaces;


interface ExpensesRequestProcessorInterface
{
    public function store($request, $user): bool;
}
