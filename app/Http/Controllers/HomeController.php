<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Expense;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = User::find(auth()->user()->id);
        $expenses = Expense::where('user_id', auth()->user()->id)->take(5)->orderby('date', 'desc')->get();
        $categories = Category::all();

        return view('home', [
            'user' => $user,
            'expenses' => $expenses,
            'categories' => $categories,
        ]);
    }
}
