@extends('layouts.app')

@section('side_menu')
    <a href="#" class="btn btn-block btn-outline-dark">Add Expense</a>
    <hr>
    <a href="{{ route('home') }}" class="btn btn-block btn-light">Home</a>
    <a href="{{ route('showExpenses') }}" class="btn btn-block btn-light">Expenses</a>
    <a href="{{ route('showIncomes') }}" class="btn btn-block btn-dark active"><b>Incomes</b></a>
    <a href="{{ route('showSummary', ['month' => date('m')]) }}" class="btn btn-block btn-light">Summary</a>
@endsection

@section('content')
<div class="container">
    <h3>Witaj {{ $user->name }}, to są twoje przychody</h3>
</div>
<div class="container">
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
            @foreach($incomes as $income)
                <tr>
                    <td>{{ $income->date }}</td>
                    <td>{{ $income->title }}</td>
                    <td>{{ $income->category }}</td>
                    <td>{{ $income->recipient }}</td>
                    <td>{{ $income->amount }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
