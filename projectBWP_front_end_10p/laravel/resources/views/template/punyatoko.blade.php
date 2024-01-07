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
                            <h5>{{ $toko->store_name }}</h5>
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
                    <p>store revenue : ${{ $toko->store_revenue }}</p>
                </div>
                <div class="col-2">
                    <h5 style="margin-left: 3vw; margin-top: 1vw;">
                        <h5><a href="{{ url('/tokosaya') }}" style="text-decoration: none; color: black">Product Saya</a>
                        </h5>
                    </h5>
                </div>
                <div class="col-2" style="margin-top: 1vw; margin-bottom: 1vw;">
                    <h5><a href="{{ url('/tokosaya/tambahproduk') }}" style="text-decoration: none; color: black">Tambah
                            Product</a>
                    </h5>
                </div>
                <div class="col-2" style="margin-top: 1vw; margin-bottom: 1vw;">
                    <h5>
                        <a href="{{ url('/tokosaya/updatetoko') }}" style="text-decoration: none; color: black">
                            Edit Toko
                        </a>
                    </h5>
                </div>
                <div class="col-2" style="margin-top: 1vw; margin-bottom: 1vw;">
                    <h5>
                        <a href="{{ url('/tokosaya/pesanan') }}" style="text-decoration: none; color: black">
                            Acc Pesanan
                        </a>
                    </h5>
                </div>
                <div class="col-2" style="margin-top: 1vw; margin-bottom: 1vw;">
                    <h5>
                        <a href="{{ url('/tokosaya/historypesanan') }}" style="text-decoration: none; color: black">
                            History Pesanan
                        </a>
                    </h5>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    @yield('content')
@endsection
