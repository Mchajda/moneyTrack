<?php

namespace App\Http\Controllers;

use App\Http\Providers\ExpensesProvider;
use App\Http\Providers\Interfaces\ExpensesProviderInterface;
use App\Http\RequestProcessors\ExpensesRequestProcessor;
use App\Http\RequestProcessors\Interfaces\ExpensesRequestProcessorInterface;
use App\Http\Services\ProfileService;
use App\Models\Expense;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;

class ExpensesController extends Controller
{
    private $provider;
    private $profileService;
    private $requestProcessor;

    public function __construct(ExpensesProvider $provider, ExpensesRequestProcessor $requestProcessor, ProfileService $service)
    {
        $this->middleware('auth');
        $this->provider = $provider;
        $this->requestProcessor = $requestProcessor;
        $this->profileService = $service;
    }

    public function store(){
        $user = auth()->user();
        $request = request();
        $this->requestProcessor->store($request, $user);

        $profile = Profile::find(auth()->user()->id);
        $this->profileService->updateBalance($request, $profile);

        return redirect()->route('home');
    }

    public function showExpenses(){
        $user_id = auth()->user()->id;
        return view('profile.expenses', [
            'user' => User::find($user_id),
            'expenses' => $this->provider->getAll($user_id),
        ]);
    }
}
