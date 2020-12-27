<?php


namespace App\Http\Providers\Interfaces;


use App\Models\User;

interface UserProviderInterface
{
    public function getOneById($id): User;
    public function getCurrentUser(): User;
}
