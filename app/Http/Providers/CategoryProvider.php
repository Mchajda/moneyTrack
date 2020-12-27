<?php


namespace App\Http\Providers;


use App\Http\Providers\Interfaces\CategoryProviderInterface;
use App\Models\Category;

class CategoryProvider implements CategoryProviderInterface
{
    public function getAll()
    {
        return Category::all();
    }

    public function getAllForChart()
    {
        return Category::all()->pluck('category_name', 'id');
    }
}
