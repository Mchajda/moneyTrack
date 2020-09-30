@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Oto podsumowanie towich wydatków</h3>
</div>
<div class="container">
    @foreach($expenses as $expense)
        {{ $expense->title }}
        {{ $expense->date }}
    @endforeach
</div>
@endsection
