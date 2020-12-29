@extends('layouts.app')

@section('side_menu')
    <a href="{{ route('addExpenseForm') }}" class="btn btn-block btn-primary"><span class="material-icons">add</span>Add Expense</a>
    <hr>
    <a href="{{ route('home') }}" class="btn btn-block btn-light text-left"><span class="material-icons mr-1">list</span>Home</a>
    <a href="{{ route('showTransactions') }}" class="btn btn-block btn-light text-left"><span class="material-icons mr-1">shopping_cart</span>Transactions</a>
    <a href="{{ route('showSummary', ['month' => date('m')]) }}" class="btn btn-block btn-light text-left"><span class="material-icons mr-1">auto_graph</span>Summary</a>
@endsection

@section('content')
    <h2>Add expense</h2>
    <div class="card">
        <div class="card-body">

            <form action="{{ route('addExpense') }}" enctype="multipart/form-data" method="post">
                @csrf

                <div class="form-group row">
                    <label for="title" class="col-sm-2 col-form-label">Title</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="title">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="date" class="col-sm-2 col-form-label">Date</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" name="date" value="<?php echo date("Y-m-d") ?>">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="category" class="col-sm-2 col-form-label">Category</label>
                    <div class="col-sm-10">
                        <select class="form-control" id="category" name="category">
                            @foreach($categories as $cat)
                                <option>{{ $cat }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="recipient" class="col-sm-2 col-form-label">Recipient</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="recipient" value="other" placeholder="add recipient...">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="amount" class="col-sm-2 col-form-label">Amount</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" name="amount" step="0.01">
                    </div>
                </div>


                <div class="form-group row" name="direction">
                    <label for="direction" class="col-sm-2 col-form-label">Direction</label>
                    <div class="form-check form-check-inline pl-3">
                        <input class="form-check-input" type="radio" name="direction" id="expense" value="expense" checked>
                        <label class="form-check-label" for="expense">Expense</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="direction" id="income" value="income">
                        <label class="form-check-label" for="income">Income</label>
                    </div>
                </div>

                <button class="btn btn-primary btn-block">Submit</button>
            </form>
        </div>
    </div>
@endsection
