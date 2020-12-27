<?php


namespace App\Http\RequestProcessors;


use App\Http\RequestProcessors\Interfaces\ExpensesRequestProcessorInterface;

class ExpensesRequestProcessor implements ExpensesRequestProcessorInterface
{
    public function store($request, $user): bool
    {
        $data = $request->validate([
            'title' => 'required',
            'date' => 'required',
            'category' => 'required',
            'recipient' => 'required',
            'amount' => 'required',
            'direction' => 'required',
        ]);

        if($request->direction == "income")
            $data['recipient'] = "me";

        if($user->expenses()->create($data))
            return true;
        return false;
    }
}
