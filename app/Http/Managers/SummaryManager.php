<?php


namespace App\Http\Managers;


use App\Charts\MonthsChart;
use App\Charts\ThisMonthChart;
use App\Http\Providers\CategoryProvider;

class SummaryManager
{
    private $categoryProvider;
    public $months;
    public $categories;
    public $colors;

    public function __construct(
        CategoryProvider $categoryProvider
    ){
        $this->categoryProvider = $categoryProvider;
        $this->months = ['1' => 'styczeń', '2' => 'luty', '3' => 'marzec', '4' => 'kwiecień', '5' => 'maj', '6' => 'czerwiec', '7' => 'lipiec', '8' => 'sierpień', '9' => 'wrzesień', '10' => 'październik', '11' => 'listopad', '12' => 'grudzień'];
        $this->colors = $colors = ['#ff5722', '#ff9800', '#ffeb3b', '#4caf50', '#2196f3', '#673ab7', '#e91e63'];
        $this->categories = $this->categoryProvider->getAll();
    }

    public function getMonth($month)
    {
        return $this->months[date('n')];
    }

    public function getCategoriesForChart()
    {
        return $this->categoryProvider->getAllForChart();
    }

    public function getThisMonthExpenses($expenses, $categories)
    {
        //this month expenses
        $this_month_expenses = [];

        foreach($categories as $cat){
            $this_month_expenses[$cat->id] = 0;
            foreach($expenses as $expense){
                if($expense->category == $cat->category_name && \Carbon\Carbon::parse($expense->date)->format('Y-m') == date('Y-m'))
                    $this_month_expenses[$cat->id] += $expense->amount;
            }
        }
        //dd($this_month_expenses);
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
                if(\Carbon\Carbon::parse($expense->date)->format('m') == $i+1)
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
