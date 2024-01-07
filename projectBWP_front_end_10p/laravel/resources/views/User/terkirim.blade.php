@extends('template.pesananSaya')

@section('status')
    @foreach ($order as $o)
        <div class="container">
            <div class="isi" style="background-color: white; width: 100%;">
                <div class="row">
                    <div class="col-1" style="margin-top: 1vw; margin-left: 1vw;">
                        <img src="/shopping.png" style="height: 3vw; width: 3vw;" alt="">
                    </div>
                    <div class="col-8" style="margin-top: 1vw;"><strong>Pesanan</strong>
                        <br>
                        {{ $o->created_at }}
                    </div>
                    <div class="col-2" style="margin-top: 1vw;">
                        <div class="kotak ps-1 text-center" style="background-color: lightyellow; "><strong>Sedang
                                Dikirim</strong></div>
                    </div>
                </div>
                <div class="container">
                    <hr>
                </div>
                <div class="row">
                    <div class="col-1">
                        <img src="{{ $o->Products->first()->product_img }}"
                            style="height: 5vw; width: 5vw; margin-left: 1vw;" alt="">
                    </div>
                    <div class="col-10" style="margin-left: 2vw;">
                        <strong>{{ $o->Products->first()->product_name }}</strong>
                        <br>
                        {{ $o->Products->first()->pivot->order_product_quantity }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-6" style="margin-left: 1vw;">

                        @if (count($o->Products) > 1)
                            <h5>+{{ count($o->Products) - 1 }} produk lainnya</h5>
                        @endif

                    </div>
                </div>
                <br>
                <div class="row" style="margin-bottom: 2vw; padding-bottom: 1vw;">
                    <div class="col-10" style="margin-left: 1vw;">
                        <strong style="font-size: larger">Total Belanja</strong>
                        <br>
                        <strong style="font-size: larger">$
                            {{ number_format($o->order_total_amount, 0, '.', ',') }}</strong>
                    </div>
                    <div class="col-1">
                        <form action="/profile/pesanansaya/sedangdikirim/selesai" method="post">
                            @csrf
                            <button class="btn btn-success" value="{{ $o->order_id }}" name="selesai">Selesai</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
