<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar sticky-top" style="background-color: black">
        <div class="">
            <a class="navbar-brand" href="#" style="color: aliceblue;">
                <img src="{{ asset('assets/ka_store.png') }}" alt="Logo" width="60" height="auto"
                    class="d-inline-block align-text-center">
                KA STORE
            </a>
        </div>
        <div class="container d-flex justify-content-center">
            <form class="d-flex">
                @csrf
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"
                    style="width: 50vw">
                <button class="btn btn-outline" style="background-color: aliceblue; color: black"
                    type="submit">Search</button>
            </form>
        </div>
        <div class="justify-content-center">
            @yield('logout')
        </div>
    </nav>

    @yield('carousel')
    @yield('content')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>
