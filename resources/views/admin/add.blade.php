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

    @if(isset($error_D))
        <div class="alert alert-danger">
            {{ $error_D }}
        </div>
    @endif

    <div class="card mt-4">
        <div class="card-body">
            <h5 class="card-title fw-bolder mb-3">Tambah Game</h5>
            <form method="post" action="{{route('admin.insert', $status)}}">
                @csrf
                <div class="mb-3">
                    <label for="id_g" class="form-label">Game ID</label>
                    <input type="number" class="form-control" id="id_g" name="id_g">
                </div>

                <div class="mb-3">
                    <label for="nama_g" class="form-label">Game Name</label>
                    <input type="text" class="form-control" id="nama_g" name="nama_g">
                </div>

                <div class="mb-3">
                    <label for="jenis_genre" class="form-label">Game Genre</label>
                    <select name="jenis_genre" id="jenis_genre" class="form-control">\
                        <option disabled selected></option>
                        <option value = "1">RPG</option>
                        <option value = "2">Action</option>
                        <option value = "3">Puzzle</option>
                        <option value = "4">FPS</option>
                        <option value = "5">Adventure</option>
                        <option value = "6">Rythm</option>
                        <option value = "7">Simulation</option>
                    </select>

                </div>

                <div class="mb-3">
                    <label for="harga" class="form-label">Game Price</label>
                    <input type="number" class="form-control" id="harga" name="harga">
                </div>

                <div class="text-center">
                    <input type="submit" class="btn btn-primary" value="Tambah" />
                </div>

            </form>
        </div>
    </div>
@stop
