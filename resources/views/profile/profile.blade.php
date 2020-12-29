@extends('layouts.app')

@section('side_menu')
    <a href="{{ route('addExpenseForm') }}" class="btn btn-block btn-outline-primary"><span class="material-icons">add</span>Add Expense</a>
    <hr>
    <a href="{{ route('home') }}" class="btn btn-block btn-light text-left"><span class="material-icons mr-1">list</span>Home</a>
    <a href="{{ route('showTransactions') }}" class="btn btn-block btn-light text-left"><span class="material-icons mr-1">shopping_cart</span>Transactions</a>
    <a href="{{ route('showSummary', ['month' => date('m')]) }}" class="btn btn-block btn-light text-left"><span class="material-icons mr-1">auto_graph</span>Summary</a>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-6 offset-3">

            <div>
                <form action="{{ route('updateBalance') }}" enctype="multipart/form-data" method="post">
                    @csrf

                    <div class="form-group row">
                        <label for="balance" class="col-sm-3 col-form-label">Balance:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="balance" placeholder="{{ $user->profile->balance }}">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">Save</button>
                </form>
            </div>

            <div class="mt-4">
                <form action="{{ route('addCategory') }}" enctype="multipart/form-data" method="post">
                    @csrf

                    <div class="form-group row">
                        <label for="category_name" class="col-sm-3 col-form-label">Add Category:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="category_name" placeholder="">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">Add</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
