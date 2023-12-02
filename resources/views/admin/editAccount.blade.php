@extends('admin.layout')

@section('content')

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach
            </ul>
        </div>
    @endif

    <div class="card mt-4">
        <div class="card-body">
            <h5 class="card-title fw-bolder mb-3">Edit Customer</h5>
            <form method="post" action="{{ route('admin.accountUpdate', $data->id_c) }}">
                @csrf

                <div class="mb-3">
                    <label for="username" class="form-label">Customer Username</label>
                    <input type="text" class="form-control" id="username" name="username"
                           value="{{ $data->username}}">
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Customer Password</label>
                    <input type="text" class="form-control" id="password" name="password"
                           value="{{ $data->password }}">
                </div>

                <div class="mb-3">
                    <label for="contact" class="form-label">Customer Contact</label>
                    <input type="text" class="form-control" id="contact" name="contact"
                           value="{{ $data->contact }}">
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Customer Address</label>
                    <input type="text" class="form-control" id="address" name="address"
                           value="{{ $data->address }}">
                </div>

                <div class="text-center">
                    <input type="submit" class="btn btn-primary" value="Update" />
                </div>

            </form>
        </div>
    </div>
@stop
