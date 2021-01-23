@extends('layouts.app')

@section('side_menu')
    <a href="{{ route('addExpenseForm') }}" class="btn btn-block btn-outline-primary"><span class="material-icons">add</span>Add Expense</a>
    <hr>
    <a href="{{ route('home') }}" class="btn btn-block btn-light text-left"><span class="material-icons mr-1">list</span>Home</a>
    <a href="{{ route('showTransactions') }}" class="btn btn-block btn-light text-left"><span class="material-icons mr-1">shopping_cart</span>Transactions</a>
    <a href="{{ route('showSummary', ['month' => date('n')]) }}" class="btn btn-block btn-primary text-left"><b><span class="material-icons mr-1">auto_graph</span>Summary</b></a>
@endsection

@section('content')
<div class="">
    <h2>Podsumowanie twoich wydatków miesiąca.</h2>
    <hr>
</div>
<div class="">
    <div class="row">
        <div class="col-3">
            <h4>{{ $previous_month_name }}</h4>
            @foreach($categories as $cat)
                <div class="d-flex justify-content-between">
                    <div><b><a class="text-dark" href="{{ route('showCategory', ['month' => date('n'), 'category' => $cat->category_name]) }}">{{ $cat->category_name }}</a></b>:</div>
                    <div>{{ $previous_month[$cat->id] }} zł</div>
                </div>
                <hr>
            @endforeach
            <div class="d-flex justify-content-between">
                <div>total:</div>
                <div>{{ $monthly_expenses[date('n')] }}</div>
            </div>
        </div>
        <div class="col-9">
            <h4>{{ $month }}</h4>
            @foreach($categories as $cat)
                <div class="d-flex justify-content-between">
                    <div><b><a class="text-dark" href="{{ route('showCategory', ['month' => date('n'), 'category' => $cat->category_name]) }}">{{ $cat->category_name }}</a></b>:</div>
                    <div>{{ $this_month[$cat->id] }} zł</div>
                </div>
                <hr>
            @endforeach
            <div class="d-flex justify-content-between">
                <div>total:</div>
                <div>{{ $monthly_expenses[date('n')] }}</div>
            </div>
        </div>
    </div>

    <div class="mt-4" style="position: relative; height:40vh; width:100%">
        <h3>Monthly expenses</h3>
        {!! $chart->container() !!}
        {!! $chart->script() !!}
    </div>

    <div class="my-4" style="position: relative; height:40vh; width:100%">
        <h3>This month expenses</h3>
        {!! $this_month_chart->container() !!}
        {!! $this_month_chart->script() !!}
    </div>
</div>

<!-- Charting library -->
<script src="https://unpkg.com/chart.js@2.9.3/dist/Chart.min.js"></script>
<!-- Chartisan -->
<script src="https://unpkg.com/@chartisan/chartjs@^2.1.0/dist/chartisan_chartjs.umd.js"></script>

@endsection
