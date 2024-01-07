@extends('template.pesananSaya')

@section('status')
    @for ($i = 0; $i < 5; $i++)
        <div class="container">
            <div class="isi" style="background-color: white; width: 100%;">
                <div class="row">
                    <div class="col-1" style="margin-top: 1vw; margin-left: 1vw;">
                        <img src="/shopping.png" style="height: 3vw; width: 3vw;" alt="">
                    </div>
                    <div class="col-9" style="margin-top: 1vw;"><strong>Pesanan</strong>
                        <br>
                        13-12-2024
                    </div>
                    <div class="col-1" style="margin-top: 1vw;">
                        <div class="kotak ps-2" style="background-color: lightgreen; "><strong>Status</strong></div>
                    </div>
                </div>
                <div class="container">
                    <hr>
                </div>
                <div class="row">
                    <div class="col-1">
                        <img src="/Carousel1.jpg" style="height: 5vw; width: 5vw; margin-left: 1vw;" alt="">
                    </div>
                    <div class="col-10" style="margin-left: 2vw;">
                        <strong>Nama Barang</strong>
                        <br>
                        jumlah barang
                    </div>
                </div>
                <div class="row">
                    <div class="col-6" style="margin-left: 1vw;">
                        <h5>+1 produk lainnya</h5>
                    </div>
                </div>
                <br>
                <div class="row" style="margin-bottom: 2vw; padding-bottom: 1vw;">
                    <div class="col-3" style="margin-left: 1vw;">
                        <strong style="font-size: larger">Total Belanja</strong>
                        <br>
                        <strong style="font-size: larger">$harga</strong>
                    </div>
                </div>
            </div>
        </div>
    @endfor
@endsection
