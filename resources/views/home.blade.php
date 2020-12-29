@extends('layouts.app')

@section('side_menu')
    <a href="{{ route('addExpenseForm') }}" class="btn btn-block btn-outline-primary"><span class="material-icons">add</span>Add Expense</a>
    <hr>
    <a href="{{ route('home') }}" class="btn btn-block btn-primary text-left"><b><span class="material-icons mr-1">list</span>Home</b></a>
    <a href="{{ route('showTransactions') }}" class="btn btn-block btn-light text-left"><span class="material-icons mr-1">shopping_cart</span>Transactions</a>
    <a href="{{ route('showSummary', ['month' => date('m')]) }}" class="btn btn-block btn-light text-left"><span class="material-icons mr-1">auto_graph</span>Summary</a>
@endsection

@section('content')
    <div class="">
        <h2> Witaj {{ $user->name }}<small>, stan twojego konta to: {{ $user->profile->balance }} zł</small></h2>
        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-body py-4">
                        <div style="position: relative; height:50vh; width:100%">
                            <h3>Ten miesiąc:</h3>

                            <div class="m-6">
                            {!! $chart->container() !!}
                            {!! $chart->script() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-6">
                <div class="card" style="border: 0px;">
                    <div class="card-body bg-light" >
                        <h3>Twoje ostatnie transakcje</h3>
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
                </div>
            </div>
        </div>

    </div>
@endsection
