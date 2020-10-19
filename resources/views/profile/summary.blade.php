@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Oto podsumowanie twoich wydatków miesiąca {{ $month }}</h3>
    poprzedniego miesiąca wydałeś {{ $monthly_expenses[date('m')-1] }} zł
    <hr>
</div>
<div class="container">
    <div class="row">
        <div class="col-3">
            <h4>{{ $previous_month_name }}</h4>
            @foreach($categories as $cat)
                <div class="d-flex justify-content-between">
                    <div><b>{{ $cat->category_name }}</b>: {{ $previous_month[$cat->id] }}</div>
                    <div>zł</div>
                </div>
                <hr>
            @endforeach
        </div>
        <div class="col-9">
            <h4>{{ $month }}</h4>
            @foreach($categories as $cat)
                <div class="d-flex justify-content-between">
                    <div><b>{{ $cat->category_name }}</b>: {{ $this_month[$cat->id] }}</div>
                    <div>zł</div>
                </div>
                <hr>
            @endforeach
        </div>
    </div>
</div>
@endsection
