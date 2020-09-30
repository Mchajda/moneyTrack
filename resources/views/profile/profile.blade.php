@extends('layouts.app')

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
