<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>KA STORE</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar sticky-top" style="background-color: black">
        <div class="">
            <a class="navbar-brand" href="{{ Auth::guard('web')->check() ? url('/homePage') : url('/') }}"
                style="color: aliceblue;">
                <img src="{{ asset('assets/ka_store.png') }}" alt="Logo" width="60" height="auto"
                    class="d-inline-block align-text-center">
                KA STORE
            </a>
        </div>
        @yield('navbar')
    </nav>

    @yield('carousel')
    @yield('category')
    @yield('login')
    @yield('register')
    @yield('header')
    @yield('content')
    @yield('rekomendasi')
    @yield('product')
    @yield('toko')
    @yield('spec')
    @yield('detail')
    @yield('keterangan')
    <footer>
        <div class="footer" style="background-color: black; height: 20vw;">
            <div class="container">
                <div class="footer-content">
                    <div class="row">
                        <div class="col-3">
                            <p style="text-decoration-style: bold; color: white; margin-top: 3vw;">Layanan Pelanggan</p>
                            <p style="color: white; margin-top: 1vw;"><a href="#"
                                    style="text-decoration: none; color: white;">Bantuan</a></p>
                            <p style="color: white; margin-top: 1vw;"><a href="#"
                                    style="text-decoration: none; color: white;">Pembayaran</a></p>
                            <p style="color: white; margin-top: 1vw;"><a href="#"
                                    style="text-decoration: none; color: white;">Hubungi Kami</a></p>
                        </div>
                        <div class="col-3">
                            <p style="text-decoration-style: bold; color: white; margin-top: 3vw;">Jelajahi KA Store</p>
                            <p style="color: white; margin-top: 1vw;"><a href="#"
                                    style="text-decoration: none; color: white;">Tentang Kami</a></p>
                            <p style="color: white; margin-top: 1vw;"><a href="#"
                                    style="text-decoration: none; color: white;">Kebijakan</a></p>
                            <p style="color: white; margin-top: 1vw;"><a href="#"
                                    style="text-decoration: none; color: white;">Affiliate</a></p>
                            <p style="color: white; margin-top: 1vw;"><a href="#"
                                    style="text-decoration: none; color: white;">Store Owner</a></p>
                        </div>
                        <div class="col-3">
                            <p style="text-decoration-style: bold; color: white; margin-top: 3vw;">Ikuti Kami</p>
                            <p style="color: white; margin-top: 1vw;"><a href="#"
                                    style="text-decoration: none; color: white;">Facebook</a></p>
                            <p style="color: white; margin-top: 1vw;"><a href="#"
                                    style="text-decoration: none; color: white;">Instagram</a></p>
                            <p style="color: white; margin-top: 1vw;"><a href="#"
                                    style="text-decoration: none; color: white;">Twitter</a></p>
                            <p style="color: white; margin-top: 1vw;"><a href="#"
                                    style="text-decoration: none; color: white;">LinkedIn</a></p>
                        </div>
                        <div class="col-3">
                            <p style="text-decoration-style: bold; color: white; margin-top: 3vw;">Kelompok</p>
                            <p style="color: white; margin-top: 1vw;">222117057 - Richcie Febrianto</p>
                            <p style="color: white; margin-top: 1vw;">222117060 - Ryu Alvino</p>
                            <p style="color: white; margin-top: 1vw;">222117065 - Thio Richie</p>
                            <p style="color: white; margin-top: 1vw;">222117067 - William Sugiarto</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>
