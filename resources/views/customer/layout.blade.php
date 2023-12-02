<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PixelPlay Palace</title>
    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }

        .navbar.bg-body-tertiary {
    background-color: red !important;
    color: white !important;
}

.navbar-brand {
    padding-top: var(--bs-navbar-brand-padding-y);
    padding-bottom: var(--bs-navbar-brand-padding-y);
    margin-right: var(--bs-navbar-brand-margin-end);
    font-size: var(--bs-navbar-brand-font-size);
    color: white !important;
    text-decoration: none;
    white-space: nowrap;
}

.navbar-expand-lg .navbar-nav .nav-link {
    padding-right: var(--bs-navbar-nav-link-padding-x);
    padding-left: var(--bs-navbar-nav-link-padding-x);
    color: white;
}

body {
    background-color: grey;
    font-family: 'Nunito', sans-serif;
}

tbody, td, tfoot, th, thead, tr {
    border-color: inherit;
    border-style: solid;
    color: white;
    border-width: 0;
}
.mt-5 {
    margin-top: 3rem!important;
    color: white;
}

.mt-3 {
    margin-top: 1rem!important;
    color: white;
}

    </style>
</head>

<body class="antialiased">
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{route('customer.home')}}"> PixelPlay Palace</a>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{route('customer.home')}}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('customer.history')}}">History</a>
                </li>
            </ul>
        </div>

        <div class="d-flex" role="search">
            <div class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    {{ $user->username }}
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{route('login')}}">Logout</a></li>

                </ul>
            </div>

        </div>

    </div>


</nav>
<div class="container">
    @yield('content')
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous">
</script>
</body>

</html>

