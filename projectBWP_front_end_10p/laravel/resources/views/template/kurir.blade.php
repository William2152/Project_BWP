<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        .menu:hover {
            color: gray !important;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-2 d-flex flex-column" style="background-color: black;">
                <img src="/profile.jpg" class=""
                    style="width: 10vw; border-radius: 100%; margin-top: 2vw; margin-left: 2vw;">
                <h4 class="text-light text-center" style="margin-top: 2vw;">{{ $user->user_nama }}</h4>
                <hr style="color: white">
                <h5 class="text-light"><a href="{{ url('/logout') }}" style="text-decoration: none; color: white;"
                        class="menu">Logout</a></h5>
                <hr style="color: white">
            </div>
            <div class="col-10 d-flex flex-column">
                <div class="flex-grow-1">
                    @yield('isimenu')
                </div>

            </div>
        </div>
    </div>
</body>

</html>
