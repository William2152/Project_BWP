@extends('template.main')
@section('content')
    <div class="container" style="margin-top: 2vw;">
        <div class="content">
            <div class="row">
                <div class="col-2">
                    <div class="profileIcon" style="display: flex">
                        <img src="/profileIcon.png" style="width: 70px; height: 70px;" alt="">
                        <div class="row">
                            <div class="col-12">
                                <p style="margin-left: 1vw; text-align: center; margin-top: 1vw;">Ryu Alvino</p>
                            </div>
                        </div>
                    </div>
                    <p class="fw-bold" style="margin-top: 1vw;">Akun Saya</p>
                    <p style="margin-top: 0.5vw;"><a href="{{ url('/profile/detail') }}"
                            style="text-decoration: none; color: black">Profile</a>
                    </p>
                    <p style="margin-top: 0.5vw;">Alamat</p>
                    <p style="margin-top: 0.5vw;"><a href="{{ url('/profile/ubahpw') }}"
                            style="text-decoration: none; color: black">Ubah Password</a></p>
                    <p class="fw-bold" style="margin-top: 1vw;">Toko Saya</p>
                    <p class="fw-bold" style="margin-top: 1vw;">Pesanan Saya</p>
                    <p class="fw-bold" style="margin-top: 1vw;">Voucher Saya</p>
                    <p class="fw-bold" style="margin-top: 1vw;">Saldo Saya</p>
                </div>
                @yield('konten')
            </div>
        </div>
    </div>
@endsection
