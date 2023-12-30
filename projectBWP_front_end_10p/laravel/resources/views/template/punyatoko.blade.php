@extends('template.main')
@section('header')
    <div class="container" style="margin-bottom: 2vw; ">
        <div class="header-toko" style="margin-top: 2vw; height: 10vw; background-color: white">
            <div class="row">
                <div class="col-4">
                    <div class="row">
                        <div class="col-4">
                            <img src="/shopping.png" style="width: 50px; height: 50px; margin-top: 1vw; margin-left: 1vw;"
                                alt="">
                        </div>
                        <div class="col-8" style="margin-top: 1vw;">
                            <h5>Nama Toko</h5>
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
                        <h5><a href="{{ url('/punyatoko') }}" style="text-decoration: none; color: black">Product Saya</a>
                        </h5>
                    </h5>
                </div>
                <div class="col-4" style="margin-top: 1vw; margin-bottom: 1vw;">
                    <h5><a href="{{ url('/tambahproduk') }}" style="text-decoration: none; color: black">Tambah Product</a>
                    </h5>
                </div>
                <div class="col-4" style="margin-top: 1vw; margin-bottom: 1vw;">
                    <h5>Edit Toko</h5>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    @yield('content')
@endsection
