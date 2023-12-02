<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PixelPlay Palace</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>

<style>
    .bg-light {
    background-color: grey !important;
}
.card {
    position: relative;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-direction: column;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 1px solid rgba(0,0,0,.125);
    border-radius: .25rem;
    border-radius: 30px;
}
</style>
<body class="bg-light">
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header" style="color: black; font-weight: bold;" >PixelPlay Palace</div>

                @if($message = Session::get('fail'))
                    <div class="alert alert-success mt-3" role="alert">
                        {{ $message }}
                    </div>
                @endif

                <div class="card-body">
                    <form method="POST" action="{{ route('auth') }}">
                        @csrf

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="role" id="customer" value="customer">
                            <label class="form-check-label" for="customer">
                                Login as Customer
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="role" id="admin" value="admin">
                            <label class="form-check-label" for="admin">
                                Login as Admin
                            </label>
                        </div>


                        <div class="form-group">
                            <label for="username">Username</label>
                            <input id="username" type="text" class="form-control" name="username" >
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input id="password" type="password" class="form-control" name="password">
                        </div>

                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-danger">
                                Login
                            </button>

                            @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>
    <div class="text-center mt-3">
        <p><a class="link-opacity-100" href="{{route('register')}}" style="color: white;">Register as Customer</a></p>
    </div>
</div>
</body>
</html>
