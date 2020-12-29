@extends('layouts.app')

@section('side_menu')
    <a href="#" class="btn btn-block btn-outline-primary"><span class="material-icons">add</span>Add Expense</a>
    <hr>
    <a href="{{ route('home') }}" class="btn btn-block btn-light text-left"><span class="material-icons mr-1">list</span>Home</a>
    <a href="{{ route('showTransactions') }}" class="btn btn-block btn-light text-left"><b><span class="material-icons mr-1">shopping_cart</span>Transactions</b></a>
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
                        <div class=""><img src="{{ asset('/assets/icons/wrench.svg') }}" class="img-fluid img-thumbnail rounded-circle p-3"></div>
                        <div class="pl-3">
                            <div class="d-flex flex-column">
                                <div class=""><b>{{ $expense->title }}</b></div>
                                <div class=""><small>{{ $expense->date }}</small></div>
                            </div>
                        </div>
                    </div>
                    <div class="">{{ $expense->amount }} PLN</div>
                </div>
            </div>
        </div>
    @endforeach

</div>
@endsection
