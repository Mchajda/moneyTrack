<?php

namespace App\Http\Controllers;

use App\Http\Providers\CategoryProvider;
use App\Http\Providers\TransactionsProvider;
use App\Http\Providers\IncomesProvider;
use App\Http\RequestProcessors\ExpensesRequestProcessor;
use App\Http\Services\ProfileService;
use App\Models\Profile;


class TransactionsController extends Controller
{
    private $transactionsProvider;
    private $profileService;
    private $requestProcessor;
    private $categoryProvider;

    public function __construct(
        TransactionsProvider $transactionsProvider,
        ExpensesRequestProcessor $requestProcessor,
        ProfileService $service,
        CategoryProvider $categoryProvider
    )
    {
        $this->middleware('auth');
        $this->transactionsProvider = $transactionsProvider;
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

    public function showTransactions(){
        return view('profile.expenses', [
            'user' => auth()->user(),
            'expenses' => $this->transactionsProvider->getAllByMonth(auth()->user()->id, date('m')),
        ]);
    }
}
