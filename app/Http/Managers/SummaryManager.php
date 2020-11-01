<?php


namespace App\Http\Managers;


use App\Charts\MonthsChart;
use App\Charts\ThisMonthChart;
use App\Models\Category;

class SummaryManager
{
    public function getThisMonthExpenses($expenses, $categories){
        //this month expenses
        $this_month_expenses = [];

        foreach($categories as $cat){
            $this_month_expenses[$cat->id] = 0;
            foreach($expenses as $expense){
                if($expense->category == $cat->category_name && \Carbon\Carbon::parse($expense->date)->format('m') == date('m'))
                    $this_month_expenses[$cat->id] += $expense->amount;
            }
        }

        return $this_month_expenses;
    }

    public function getPreviousMonthExpenses($expenses, $categories){
        //previous month expenses
        $previous_month_expenses = [];

        foreach($categories as $cat){
            $previous_month_expenses[$cat->id] = 0;
            foreach($expenses as $expense){
                if($expense->category == $cat->category_name && \Carbon\Carbon::parse($expense->date)->format('m') == (date('m')-1))
                    $previous_month_expenses[$cat->id] += $expense->amount;
            }
        }

        return $previous_month_expenses;
    }

    public function getMonthlyExpenses($expenses){
        //wydatki posegregowane na miesiace np do rocznego zestawienia
        $monthly_expenses = [];

        for( $i=0 ; $i<12 ; $i++){
            $monthly_sum = 0;
            foreach($expenses as $expense){
                if(\Carbon\Carbon::parse($expense->date)->format('m') == $i)
                    $monthly_sum += $expense->amount;
            }
            $monthly_expenses[$i] = $monthly_sum;
        }

        return $monthly_expenses;
    }

    public function createChart($labels, $data, $type, $title, $color, $axes, $minimalist){
        if($type == 'bar')
            $chart = new MonthsChart($axes);
        elseif($type == 'doughnut')
            $chart = new ThisMonthChart($axes, $minimalist);

        $chart->labels($labels);
        $chart->dataset($title, $type, $data)->backgroundColor($color);

        return $chart;
    }
}
