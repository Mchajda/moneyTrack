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
        $last5expenses = Expense::where('user_id', auth()->user()->id)->take(5)->orderby('date', 'desc')->get();
        $expenses = Expense::where('user_id', auth()->user()->id)->where('direction', 'expense')->get();
        $categories = Category::all();

        $months = ['styczeń', 'luty', 'marzec', 'kwiecień', 'maj', 'czerwiec', 'lipiec', 'sierpień', 'wrzesień', 'październik', 'listopad', 'grudzień'];
        $monthly_expenses = $this->summaryManager->getMonthlyExpenses($expenses);
        $chart = $this->summaryManager->createMonthlyChart($months, $monthly_expenses);

        return view('home', [
            'user' => $user,
            'expenses' => $last5expenses,
            'categories' => $categories,
            'chart' => $chart,
        ]);
    }
}
