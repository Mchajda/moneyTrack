<?php


namespace App\Http\Services;


class ProfileService
{
    public function updateBalance($request, $profile)
    {
        if($request->direction == "expense"){
            $newBalance = $profile->balance - $request->amount;
        }else if($request->direction == "income"){
            $newBalance = $profile->balance + $request->amount;
        }

        $profile->balance = $newBalance;

        if($profile->save())
            return true;
        else return false;
    }
}
