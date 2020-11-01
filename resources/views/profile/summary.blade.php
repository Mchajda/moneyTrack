@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Oto podsumowanie twoich wydatków miesiąca.</h3>
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
                <div>razem:</div>
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
                <div>razem:</div>
                <div>{{ array_sum($this_month) }}</div>
            </div>
        </div>
    </div>
</div>
@endsection
