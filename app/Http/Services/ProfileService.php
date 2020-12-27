<?php


namespace App\Http\Services;


use App\Models\Profile;

class ProfileService
{
    public function updateBalance($request, $profile): bool
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

    public function changeBalance($request, $profile): bool
    {
        $data = $request->validate(['balance' => 'required']);

        $profile->balance = $data['balance'];
         if($profile->save())
             return true;
         else return false;
    }
}
