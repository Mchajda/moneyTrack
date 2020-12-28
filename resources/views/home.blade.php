@extends('layouts.app')

@section('side_menu')
    <a href="#" class="btn btn-block btn-outline-dark">Add Expense</a>
    <hr>
    <a href="{{ route('home') }}" class="btn btn-block btn-dark active"><b>Home</b></a>
    <a href="{{ route('showExpenses') }}" class="btn btn-block btn-light">Expenses</a>
    <a href="{{ route('showIncomes') }}" class="btn btn-block btn-light">Incomes</a>
    <a href="{{ route('showSummary', ['month' => date('m')]) }}" class="btn btn-block btn-light">Summary</a>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-6">
                <div>
                    witaj {{ $user->name }}, stan twojego konta to: {{ $user->profile->balance }} zł
                </div>
                <div>
                    {!! $chart->container() !!}
                    {!! $chart->script() !!}
                </div>
            </div>
            <div class="col-6">
                <h2>Add expense</h2>
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
                                <option>other</option>
                                @foreach($categories as $cat)
                                    <option>{{ $cat->category_name }}</option>
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

        <!-- last transactions -->
        <div class="container mt-5">
            <div class="row">
                <table class="table table-striped table-hover table-bordered table-sm">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">data</th>
                        <th scope="col">tytuł</th>
                        <th scope="col">kategoria</th>
                        <th scope="col">odbiorca</th>
                        <th scope="col">kwota</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($expenses as $expense)
                        <tr>
                            <td>{{ $expense->date }}</td>
                            <td>{{ $expense->title }}</td>
                            <td>{{ $expense->category }}</td>
                            <td>{{ $expense->recipient }}</td>
                            <td>{{ $expense->amount }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
