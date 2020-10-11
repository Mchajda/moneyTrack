<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\User;
use Illuminate\Http\Request;

class ProfilesController extends Controller
{
    public function index(){
        $user = User::find(auth()->user()->id);
        return view('profile.profile', [
            'user' => $user,
        ]);
    }

    public function updateBalance(User $user){
        $data = request()->validate([
            'balance' => 'required',
        ]);

        auth()->user()->profile()->update($data);
        return redirect()->route('home');
        //dd(request()->all());
    }

    public function showExpenses(){
        $user = User::find(auth()->user()->id);
        return view('profile.expenses', [
            'user' => $user,
        ]);
    }

    public function showIncomes(){
        $user = User::find(auth()->user()->id);
        return view('profile.incomes', [
            'user' => $user,
        ]);
    }

    public function showSummary(){
        $user = User::find(auth()->user()->id);

        /*
        $from = date('2020-10-01');
        $to = date('2020-10-31');
        $expenses = Expense::whereBetween('date', [$from, $to])->get();
        */
        $expenses = Expense::where('user_id', auth()->user()->id)->get();

        return view('profile.summary', [
            'user' => $user,
            'expenses' => $expenses,
        ]);
    }
}
