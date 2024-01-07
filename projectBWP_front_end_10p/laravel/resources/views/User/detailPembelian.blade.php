@extends('template.profilePage')
@section('konten')
    <div class="col-10" style="margin-top: 1vw; margin-bottom: 1vw; height: auto;">
        <h1 style="text-align: center">Detail</h1>
        @if ($errors->any())
            <div class="alert alert-danger">{{ $errors->first() }}</div>
            {{-- @foreach ($errors->all() as $pesanError)
                @endforeach --}}
        @elseif (Session::has('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>
        @elseif (Session::has('err'))
            <div class="alert alert-danger">{{ Session::get('err') }}</div>
        @endif
        <div class="container"
            style="background-color: whitesmoke; margin-top: 1vw; margin-bottom: 1vw; height: auto; padding-top: 1vw; padding-bottom: 1vw; display: flex; flex-direction: column; justify-content: center;">
            @foreach ($product as $p)
                <div class="boxItem"
                    style="margin-right: 1vw; margin-left: 1vw; background-color: aliceblue; width: 100% -2vw; padding-bottom: 1vw; display: flex;  flex-direction: row; margin-bottom: 1vw; margin-top: 1vw;">
                    <div class="imageBox" style="width: 30%; height: 17vw;">
                        <img src="{{ $p->product_img }}" alt="" style="width: 17vw; height: 17vw;">
                    </div>
                    <div class="descBox" style="width: 60%; height: 100%; padding-top: 4vw; padding-left: 1vw;">
                        <h5>Nama Barang : {{ $p->product_name }} </h5> <br>
                        <h5>Harga per Item : {{ $p->product_price }}</h5> <br>
                        <h5>Quantity : {{ $p->pivot->order_product_quantity }}</h5> <br>
                    </div>
                </div>
            @endforeach
            <a href="{{ url('/profile/saldosaya/history/pembelian') }}" class="btn btn-danger">Back</a>
        </div>
    </div>
@endsection
