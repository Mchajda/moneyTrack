@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-6 offset-3">
            <form action="{{ route('updateBalance') }}" enctype="multipart/form-data" method="post">
                @csrf

                <div class="form-group row">
                    <label for="balance" class="col-sm-2 col-form-label">Balance:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="balance" placeholder="{{ $user->profile->balance }}">
                    </div>
                </div>

                <button class="btn btn-primary btn-block">Save</button>
            </form>
        </div>
    </div>
</div>
@endsection
