@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Oto podsumowanie towich wydatków miesiąca <?php echo date('m')?></h3>
</div>
<div class="container">
    @foreach($expenses as $expense)
        @if(\Carbon\Carbon::parse($expense->date)->format('M') == 'Oct')
            {{ $expense->title }}
        @endif
        
    @endforeach
</div>
@endsection
