@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Oto podsumowanie twoich wydatków miesiąca {{ $month }}</h3>
    poprzedniego miesiąca wydałeś {{ $monthly_expenses[date('m')-1] }} zł
    <hr>
</div>
<div class="container">
    @foreach($categories as $cat)
        <div class="d-flex justify-content-between">
            <div><b>{{ $cat->category_name }}</b>: {{ $this_month[$cat->id] }}</div>
            <div>zł</div>
        </div>
        <hr>
    @endforeach
</div>
@endsection
