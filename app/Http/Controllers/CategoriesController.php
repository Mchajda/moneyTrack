<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(){
        $data = request()->validate([
            'category_name' => 'required',
        ]);

        //dd($data);
        //create($data);

        $category = new Category();
        $category->category_name = $data['category_name'];
        $category->save();

        return redirect()->route('home');

    }
}
