<?php

namespace App\Http\Controllers;

use App\Http\Managers\SummaryManager;
use App\Http\Providers\TransactionsProvider;
use App\Http\Services\ProfileService;

class SummaryController extends Controller
{
    private $summaryManager;
    private $profileService;
    private $expensesProvider;

    public function __construct(
        SummaryManager $manager,
        ProfileService $profileService,
        TransactionsProvider $expensesProvider
    ){
        $this->summaryManager = $manager;
        $this->profileService = $profileService;
        $this->expensesProvider = $expensesProvider;
    }

    public function showSummary($month){
        $expenses = $this->expensesProvider->getAllExpenses(auth()->user()->id);

        return view('profile.summary', [
            'user' => auth()->user(),
            'month' => $this->summaryManager->getMonth($month),
            'previous_month_name' => $this->summaryManager->getMonth($month-1),
            'categories' => $this->summaryManager->categories,
            'this_month' => $this->summaryManager->getThisMonthExpenses($expenses, $this->summaryManager->categories),
            'previous_month' => $this->summaryManager->getPreviousMonthExpenses($expenses, $this->summaryManager->categories),
            'monthly_expenses' => $this->summaryManager->getMonthlyExpenses($expenses),
            'chart' => $this->summaryManager->createChart($this->summaryManager->months, $this->summaryManager->getMonthlyExpenses($expenses), 'bar', 'Monthly expenses', '#007bff', 'true', 'false'),
            'this_month_chart' => $this->summaryManager->createChart($this->summaryManager->getCategoriesForChart()->values(), array_values($this->summaryManager->getThisMonthExpenses($expenses, $this->summaryManager->categories)), 'doughnut', 'This month expenses', $this->summaryManager->colors, false, false),
        ]);
    }

    public function showCategory($month, $category){
        return view('profile.category.expenses', [
            'user' => auth()->user(),
            'expenses' => $this->expensesProvider->getAllExpensesByCategory(auth()->user()->id, $category, $month),
        ]);
    }
}
