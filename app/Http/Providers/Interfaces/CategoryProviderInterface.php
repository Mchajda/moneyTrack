<?php


namespace App\Http\Providers\Interfaces;


interface CategoryProviderInterface
{
    public function getAll();
    public function getAllForChart();
}
