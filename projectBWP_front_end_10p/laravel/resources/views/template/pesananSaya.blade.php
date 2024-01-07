@extends('template.profilePage')

<style>
    .col-4:hover {
        transform: scale(1.05);
    }
</style>

@section('konten')
    <div class="col-10" style="background-color: whitesmoke; height: auto; margin-bottom: 2vw;">
        <div class="container" style="display: flex; flex-direction: column; justify-content: center;">
            <h2 style="margin-top: 0.8vw; margin-left: 0.3vw; margin-bottom: 1vw;">Pesanan Saya</h2>
            <div class="row" style="margin-top: 2vw;">
                <div class="col-4">
                    <h4 class="menu"><a href={{ url('/profile/pesanansaya/belumdikirim') }}
                            style="text-decoration: none; color:black">Belum Diproses</a></h4>
                </div>
                <div class="col-4">
                    <h4 class="menu"><a href="{{ url('/profile/pesanansaya/sedangdikirim') }}"
                            style="text-decoration: none; color: black">Sedang Dikirim</a></h4>
                </div>
                <div class="col-4">
                    <h4 class="menu"><a href="{{ url('/profile/pesanansaya/selesai') }}"
                            style="text-decoration: none; color: black">Selesai</a></h4>
                </div>
                <hr style="">
            </div>

            <div class="container" style="margin-top: 1vw;">
                @yield('status')
            </div>
        </div>
    </div>
@endsection
