<?php

namespace App\Http\Controllers;

use App\Models\Profile;
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
            $newBalance = auth()->user()->profile->first()->balance - request()->amount;
        }else if(request()->direction == "income"){
            $newBalance = auth()->user()->profile->first()->balance + request()->amount;
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
}
