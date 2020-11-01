@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Podsumowanie twoich wydatków miesiąca.</h3>
    <hr>
</div>
<div class="container">
    <div class="row">
        <div class="col-3">
            <h4>{{ $previous_month_name }}</h4>
            @foreach($categories as $cat)
                <div class="d-flex justify-content-between">
                    <div><b>{{ $cat->category_name }}</b>:</div>
                    <div>{{ $previous_month[$cat->id] }} zł</div>
                </div>
                <hr>
            @endforeach
            <div class="d-flex justify-content-between">
                <div>total:</div>
                <div>{{ $monthly_expenses[date('m')-1] }}</div>
            </div>
        </div>
        <div class="col-9">
            <h4>{{ $month }}</h4>
            @foreach($categories as $cat)
                <div class="d-flex justify-content-between">
                    <div><b>{{ $cat->category_name }}</b>:</div>
                    <div>{{ $this_month[$cat->id] }} zł</div>
                </div>
                <hr>
            @endforeach
            <div class="d-flex justify-content-between">
                <div>total:</div>
                <div>{{ array_sum($this_month) }}</div>
            </div>
        </div>
    </div>

    <div class="pt-4">
        <h3>Monthly expenses</h3>
        {!! $chart->container() !!}
        {!! $chart->script() !!}
    </div>

    <div class="pt-4">
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
