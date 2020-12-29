@extends('layouts.app')

@section('side_menu')
    <a href="{{ route('addExpenseForm') }}" class="btn btn-block btn-outline-primary"><span class="material-icons">add</span>Add Expense</a>
    <hr>
    <a href="{{ route('home') }}" class="btn btn-block btn-light text-left"><span class="material-icons mr-1">list</span>Home</a>
    <a href="{{ route('showTransactions') }}" class="btn btn-block btn-primary text-left"><b><span class="material-icons mr-1">shopping_cart</span>Transactions</b></a>
    <a href="{{ route('showSummary', ['month' => date('m')]) }}" class="btn btn-block btn-light text-left"><span class="material-icons mr-1">auto_graph</span>Summary</a>
@endsection

@section('content')
<div class="mb-2">
    <h2>Witaj {{ $user->name }}, to są twoje wydatki</h2>
</div>
<div class="">

    @foreach($expenses as $expense)
        <div class="card my-2">
            <div class="card-body pt-2 pb-2">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <div class="border rounded-circle p-2">
                            <a href="{{ route('showCategory', ['month' => date('m'), 'category' => $expense->category]) }}">
                                <img src="{{ asset($expense->getCategoryImg($expense->category)) }}" class="img-fluid" style="width: 36px; height: 36px;">
                            </a>
                        </div>
                        <div class="pl-3">
                            <div class="d-flex flex-column">
                                <div class=""><b>{{ $expense->title }}</b></div>
                                <div class=""><small>{{ $expense->date }}</small></div>
                            </div>
                        </div>
                    </div>
                    <div>
                        @if($expense->direction == "income")
                            <span class="text-success">+{{ $expense->amount }} PLN</span>
                        @else
                            <span class="text-danger">-{{ $expense->amount }} PLN</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endforeach

</div>
@endsection
