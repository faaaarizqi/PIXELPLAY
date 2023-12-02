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
            <h5 class="card-title fw-bolder mb-3">Edit Game</h5>
            <form method="post" action="{{ route('admin.update', $data->id_g) }}">
                @csrf

                <div class="mb-3">
                    <label for="id_g" class="form-label">Game ID</label>
                    <input type="text" class="form-control" id="id_g" name="id_g"
                           value="{{ $data->id_g }}" disabled>
                </div>

                <div class="mb-3">
                    <label for="nama_g" class="form-label">Game Name</label>
                    <input type="text" class="form-control" id="nama_g" name="nama_g"
                           value="{{ $data->nama_g }}">
                </div>

                <div class="mb-3">
                    <label for="jenis_genre" class="form-label">Game Genre</label>
                    <select name="jenis_genre" id="jenis_genre" class="form-control"
                        {{--                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 invalid:text-gray-500" --}}
                    >
                        <option value= "{{ $unitGenre->id_gen  }}">{{ $unitGenre->jenis_genre }}</option>
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
                    <label for="harga" class="form-label">Unit Price</label>
                    <input type="number" class="form-control" id="harga" name="harga" value="{{ $data->harga }}">
                </div>


                <div class="text-center">
                    <input type="submit" class="btn btn-primary" value="Update" />
                </div>

            </form>
        </div>
    </div>
@stop
