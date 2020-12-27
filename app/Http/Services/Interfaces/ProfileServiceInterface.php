<?php


namespace App\Http\Services\Interfaces;


interface ProfileServiceInterface
{
    public function updateBalance($request, $profile): bool;
    public function changeBalance($request, $profile): bool;
}
