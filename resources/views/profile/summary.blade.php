@extends('layouts.app')

@section('side_menu')
    <a href="{{ route('showExpenses') }}" class="btn btn-block btn-primary"><b>Expenses</b></a>
    <a href="{{ route('showIncomes') }}" class="btn btn-block btn-light">Incomes</a>
    <a href="{{ route('showSummary', ['month' => date('m')]) }}" class="btn btn-block btn-light">Summary</a>
@endsection

@section('content')
<div class="container-fluid">
    <h3>Podsumowanie twoich wydatków miesiąca.</h3>
    <hr>
</div>
<div class="container">
    <div class="row">
        <div class="col-3">
            <h4>{{ $previous_month_name }}</h4>
            @foreach($categories as $cat)
                <div class="d-flex justify-content-between">
                    <div><b><a class="text-dark" href="{{ route('showCategory', ['month' => date('m')-1, 'category' => $cat->category_name]) }}">{{ $cat->category_name }}</a></b>:</div>
                    <div>{{ $previous_month[$cat->id] }} zł</div>
                </div>
                <hr>
            @endforeach
            <div class="d-flex justify-content-between">
                <div>total:</div>
                <div>{{ $monthly_expenses[date('m')-2] }}</div>
            </div>
        </div>
        <div class="col-9">
            <h4>{{ $month }}</h4>
            @foreach($categories as $cat)
                <div class="d-flex justify-content-between">
                    <div><b><a class="text-dark" href="{{ route('showCategory', ['month' => date('m'), 'category' => $cat->category_name]) }}">{{ $cat->category_name }}</a></b>:</div>
                    <div>{{ $this_month[$cat->id] }} zł</div>
                </div>
                <hr>
            @endforeach
            <div class="d-flex justify-content-between">
                <div>total:</div>
                <div>{{ $monthly_expenses[date('m')-1] }}</div>
            </div>
        </div>
    </div>

    <div class="mt-4" style="position: relative; height:40vh; width:100%">
        <h3>Monthly expenses</h3>
        {!! $chart->container() !!}
        {!! $chart->script() !!}
    </div>

    <div class="mt-4" style="position: relative; height:40vh; width:100%">
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
