<?php

namespace App\Http\Controllers;

use App\Charts\MonthsChart;
use App\Http\Managers\SummaryManager;
use App\Models\Category;
use App\Models\Expense;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;

class ProfilesController extends Controller
{
    private $summaryManager;

    public function __construct(SummaryManager $manager){
        $this->summaryManager = $manager;
    }

    public function index(){
        $user = User::find(auth()->user()->id);
        return view('profile.profile', [
            'user' => $user,
        ]);
    }

    public function updateBalance(){
        $data = request()->validate([
            'balance' => 'required',
        ]);

        $profile = Profile::where('user_id', auth()->user()->id)->get();
        $profile[0]->balance = $data['balance'];
        $profile[0]->save();

        return redirect()->route('home');
    }

    public function showIncomes(){
        $user = User::find(auth()->user()->id);
        return view('profile.incomes', [
            'user' => $user,
        ]);
    }

    public function showSummary(){
        $user = User::find(auth()->user()->id);
        $expenses = Expense::where('user_id', auth()->user()->id)->where('direction', 'expense')->get();

        $months = ['styczeń', 'luty', 'marzec', 'kwiecień', 'maj', 'czerwiec', 'lipiec', 'sierpień', 'wrzesień', 'październik', 'listopad', 'grudzień'];
        $categories = Category::all();
        $categoriesForChart = Category::all()->pluck('category_name', 'id');

        $this_month = $months[date('m')-1];
        $previous_month = $months[date('m')-2];

        $this_month_expenses = $this->summaryManager->getThisMonthExpenses($expenses, $categories);
        $previous_month_expenses = $this->summaryManager->getPreviousMonthExpenses($expenses, $categories);;
        $monthly_expenses = $this->summaryManager->getMonthlyExpenses($expenses);

        $monthly_chart = $this->summaryManager->createChart($months, $monthly_expenses, 'bar', 'Monthly expenses', '#007bff', 'true', 'false');
        $colors = ['red', 'blue', 'green', 'yellow', 'orange', 'purple', 'grey'];
        $this_month_chart  = $this->summaryManager->createChart($categoriesForChart->values(), array_values($this_month_expenses), 'doughnut', 'This month expenses', $colors, false, false);

        return view('profile.summary', [
            'user' => $user, 'month' => $this_month,
            'previous_month_name' => $previous_month, 'categories' => $categories,
            'this_month' => $this_month_expenses, 'previous_month' => $previous_month_expenses,
            'monthly_expenses' => $monthly_expenses, 'chart' => $monthly_chart,
            'this_month_chart' => $this_month_chart,
        ]);
    }
}
