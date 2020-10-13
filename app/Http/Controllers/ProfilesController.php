<?php

namespace App\Http\Controllers;

use App\Models\Category;
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
        $months = ['styczeń', 'luty', 'marzec', 'kwiecień', 'maj', 'czerwiec', 'lipiec', 'sierpień', 'wrzesień', 'październik', 'listopad', 'grudzień'];
        $this_month = $months[date('m')-1];
        $categories = Category::all();
        $this_month_expenses = [];
        $expenses = Expense::where('user_id', auth()->user()->id)->where('direction', 'expense')->get();

        foreach($categories as $cat){
            $this_month_expenses[$cat->id] = 0;
            foreach($expenses as $expense){
                if($expense->category == $cat->category_name)
                    $this_month_expenses[$cat->id] += $expense->amount;
            }
        }

        /*
         * wydatki posegregowane na miesiace np do rocznego zestawienia
         */
        for( $i=0 ; $i<12 ; $i++){
            $monthly_sum = 0;
            foreach($expenses as $expense){
                if(\Carbon\Carbon::parse($expense->date)->format('m') == $i)
                    $monthly_sum += $expense->amount;
            }
            $monthly_expenses[$i] = $monthly_sum;
        }

        /*
        $from = date('2020-10-01');
        $to = date('2020-10-31');
        $expenses = Expense::whereBetween('date', [$from, $to])->get();
        */

        return view('profile.summary', [
            'user' => $user,
            'expenses' => $expenses,
            'month' => $this_month,
            'this_month' => $this_month_expenses,
            'monthly_expenses' => $monthly_expenses,
            'categories' => $categories,
        ]);
    }
}
