<?php


namespace App\Http\Providers;


use App\Http\Providers\Interfaces\UserProviderInterface;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserProvider implements UserProviderInterface
{
    public function getOneById($id): User
    {
        return User::find($id);
    }

    public function getCurrentUser(): User
    {
        return Auth::user()->getAuthIdentifier();
    }
}
