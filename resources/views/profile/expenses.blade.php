@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Witaj {{ $user->name }}, to są twoje wydatki</h3>
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
            @foreach($expenses as $expense)
                @if($expense->direction == 'expense')
                    <tr>
                        <td>{{ $expense->date }}</td>
                        <td>{{ $expense->title }}</td>
                        <td>{{ $expense->category }}</td>
                        <td>{{ $expense->recipient }}</td>
                        <td>{{ $expense->amount }}</td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
</div>
@endsection
