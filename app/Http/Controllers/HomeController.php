<?php

namespace App\Http\Controllers;

use App\Http\Managers\SummaryManager;
use App\Models\Category;
use App\Models\Expense;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $summaryManager;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(SummaryManager $manager)
    {
        $this->middleware('auth');
        $this->summaryManager = $manager;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = User::find(auth()->user()->id);
        $last5expenses = Expense::where('user_id', auth()->user()->id)->take(5)->orderBy('date', 'DESC')->orderBy('created_at', 'DESC')->get();
        $expenses = Expense::where('user_id', auth()->user()->id)->where('direction', 'expense')->get();
        $categories = Category::all();

        $categoriesForChart = Category::all()->pluck('category_name', 'id');
        $this_month_expenses = $this->summaryManager->getThisMonthExpenses($expenses, $categories);
        $this->colors = $colors = ['#ff5722', '#ff9800', '#ffeb3b', '#4caf50', '#2196f3', '#673ab7', '#e91e63'];
        $monthly_chart = $this->summaryManager->createChart($categoriesForChart->values(), array_values($this_month_expenses), 'doughnut', 'This month expenses', $colors, false, true);

        return view('home', [
            'user' => $user,
            'expenses' => $last5expenses,
            'categories' => $categories,
            'chart' => $monthly_chart,
        ]);
    }
}
