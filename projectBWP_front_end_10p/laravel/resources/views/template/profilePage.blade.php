@extends('template.main')
@section('content')
    <div class="container" style="margin-top: 2vw;">
        <div class="content">
            <div class="row">
                <div class="col-2">
                    <div class="profileIcon" style="display: flex">
                        <img src="{{ $curr->user_img == null ? '/profileIcon.png' : $curr->user_img }}"
                            style="width: 70px; height: 70px;" alt="">
                        <div class="row ms-2">
                            <div class="col-12 d-flex justify-content-center align-items-center pt-2">
                                <p class="fs-5">{{ $curr->user_nama }}</p>
                            </div>
                        </div>
                    </div>
                    <p class="fw-bold" style="margin-top: 1vw;">Akun Saya</p>
                    <p style="margin-top: 0.5vw;"><a href="{{ url('/profile/detail') }}"
                            style="text-decoration: none; color: black">Profile</a>
                    </p>
                    <p style="margin-top: 0.5vw;"><a href="{{ url('/profile/ubahpw') }}"
                            style="text-decoration: none; color: black">Ubah Password</a></p>
                    <p class="fw-bold" style="margin-top: 1vw;"><a href="{{ url('/profile/tokosaya') }}"
                            style="text-decoration: none; color: black">Toko Saya</a></p>
                    <p class="fw-bold" style="margin-top: 1vw;">Keranjang Saya</p>
                    <p class="fw-bold" style="margin-top: 1vw;"><a href="{{ url('/profile/pesanansaya') }}"
                            style="text-decoration: none; color: black">Pesanan Saya</a></p>
                    <p class="fw-bold" style="margin-top: 1vw;"><a href="{{ url('/profile/vouchersaya') }}"
                            style="text-decoration: none; color: black">Voucher Saya</a></p>
                    <p class="fw-bold" style="margin-top: 1vw;"><a href="{{ url('/profile/saldosaya') }}"
                            style="text-decoration: none; color: black">Saldo Saya</a></p>
                </div>
                @yield('konten')
            </div>
        </div>
    </div>
@endsection
