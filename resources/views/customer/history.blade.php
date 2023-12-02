@extends('customer.layout')

@section('content')

    <div class="mt-4" style="color: white;">
        <h2 style="color: white; font-weight: bold;">Transaction History</h2>
    </div>

    @if($message = Session::get('success'))
        <div class="alert alert-success mt-3" role="alert">
            {{ $message }}
        </div>
    @endif

    <table class="table table-hover mt-2">
        <thead>
        <tr>
            <th>Customer Username</th>
            <th>Game Name</th>
            <th>Game Genre</th>
            <th>Quantity</th>
            <th>Total Price</th>
            <th>Time</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($datas as $data)
            <tr>
                <td>{{ $data->customer }}</td>
                <td>{{ $data->game }}</td>
                <td>{{ $data->genre }}</td>
                <td>{{ $data->quantity }}</td>
                <td>{{ str_replace(',', '.', number_format($data->price)) }}</td>
                <td>{{ $data->time }}</td>

            </tr>
        @endforeach
        </tbody>
    </table>


@stop
