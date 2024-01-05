@extends('template.main')
@section('header')
    <div class="container" style="margin-bottom: 2vw; ">
        <div class="header-toko" style="margin-top: 2vw; height: 10vw; background-color: white">
            <div class="row">
                <div class="col-4">
                    <div class="row h-100">
                        <div class="col-4 d-flex align-items-center">
                            <img src="{{ $toko->store_img == null ? '/shopping.png' : $toko->store_img }}"
                                style="width: 100px; height: 100px; margin-top: 1vw;" alt="">
                        </div>
                        <div class="col-8 d-flex align-items-center" style="margin-top: 1vw;">
                            <h5> {{ $toko->store_name }} </h5>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <P>Produk</P>
                    <P>Mengikuti</P>
                    <P>Status</P>
                </div>
                <div class="col-4">
                    <p>Pengikut</p>
                    <p>Penilaian</p>
                    <p></p>
                </div>
                <div class="col-4">
                    <h5 style="margin-left: 3vw; margin-top: 1vw;">
                        <h5><a href="{{ url('/liattoko/produk/' . $toko->store_id) }}"
                                style="text-decoration: none; color: black">Produk</a>
                        </h5>
                    </h5>
                </div>
                <div class="col-4" style="margin-top: 1vw; margin-bottom: 1vw;">
                    <h5><a href="{{ url('/liattoko/tentangtoko') }}" style="text-decoration: none; color: black">Tentang
                            Toko</a>
                    </h5>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    @yield('content')
@endsection
