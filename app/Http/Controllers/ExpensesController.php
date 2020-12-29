<?php

namespace App\Http\Controllers;

use App\Http\Providers\CategoryProvider;
use App\Http\Providers\ExpensesProvider;
use App\Http\Providers\IncomesProvider;
use App\Http\RequestProcessors\ExpensesRequestProcessor;
use App\Http\Services\ProfileService;
use App\Models\Profile;


class ExpensesController extends Controller
{
    private $expensesProvider;
    private $incomesProvider;
    private $profileService;
    private $requestProcessor;
    private $categoryProvider;

    public function __construct(
        ExpensesProvider $expensesProvider,
        ExpensesRequestProcessor $requestProcessor,
        ProfileService $service,
        IncomesProvider $incomesProvider,
        CategoryProvider $categoryProvider
    )
    {
        $this->middleware('auth');
        $this->expensesProvider = $expensesProvider;
        $this->incomesProvider = $incomesProvider;
        $this->requestProcessor = $requestProcessor;
        $this->profileService = $service;
        $this->categoryProvider = $categoryProvider;
    }

    public function addExpense()
    {
        return view('addExpense', [
            'categories' => $this->categoryProvider->getAllForChart(),
        ]);
    }

    public function store(){
        /*$user = auth()->user(); $request = request(); $profile = Profile::find(auth()->user()->id);*/
        $this->requestProcessor->store(request(), auth()->user());
        $this->profileService->updateBalance(request(), Profile::find(auth()->user()->id));

        return redirect()->route('home');
    }

    public function showExpenses(){
        return view('profile.expenses', [
            'user' => auth()->user(),
            'expenses' => $this->expensesProvider->getAll(auth()->user()->id),
        ]);
    }

    public function showIncomes(){
        return view('profile.incomes', [
            'user' => auth()->user(),
            'incomes' => $this->incomesProvider->getAll(auth()->user()->id),
        ]);
    }
}
