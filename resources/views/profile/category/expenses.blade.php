@extends('layouts.app')

@section('side_menu')
    <a href="#" class="btn btn-block btn-outline-primary"><span class="material-icons">add</span>Add Expense</a>
    <hr>
    <a href="{{ route('home') }}" class="btn btn-block btn-light text-left"><span class="material-icons mr-1">list</span>Home</a>
    <a href="{{ route('showTransactions') }}" class="btn btn-block btn-light text-left"><span class="material-icons mr-1">shopping_cart</span>Transactions</a>
    <a href="{{ route('showSummary', ['month' => date('m')]) }}" class="btn btn-block btn-primary text-left"><b><span class="material-icons mr-1">auto_graph</span>Summary</b></a>
@endsection

@section('content')
<div class="">
    <h2>Witaj {{ $user->name }}, to są twoje wydatki w kategorii {{ $category }}</h2>
</div>
<div class="">
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
        <span style="display: none;">{{ $total = 0 }}</span>
            @foreach($expenses as $expense)
                <tr>
                    <td>{{ $expense->date }}</td>
                    <td>{{ $expense->title }}</td>
                    <td>{{ $expense->category }}</td>
                    <td>{{ $expense->recipient }}</td>
                    <td>{{ $expense->amount }}<span style="display: none;">{{ $total += $expense->amount }}</span></td>
                </tr>
            @endforeach
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>{{ $total }}</td>
                </tr>
        </tbody>
    </table>
</div>
@endsection
