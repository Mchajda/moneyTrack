<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;

class ExpensesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(){
        $data = request()->validate([
            'title' => 'required',
            'date' => 'required',
            'category' => 'required',
            'recipient' => 'required',
            'amount' => 'required',
            'direction' => 'required',
        ]);

        if(request()->direction == "expense"){
            $newBalance = auth()->user()->profile->balance - request()->amount;
        }else if(request()->direction == "income"){
            $newBalance = auth()->user()->profile->balance + request()->amount;
            $data['recipient'] = "me";
        }

        //updating balance
        $profile = Profile::find(auth()->user()->id);
        $profile->balance = $newBalance;

        //saving all data
        $profile->save();
        auth()->user()->expenses()->create($data);

        return redirect()->route('home');

    }

    public function showExpenses(){
        $user = User::find(auth()->user()->id);
        $user_expenses = Expense::where('user_id', auth()->user()->id)->orderBy('date', 'DESC')->orderBy('created_at', 'DESC')->get();
        return view('profile.expenses', [
            'user' => $user,
            'expenses' => $user_expenses,
        ]);
    }
}
