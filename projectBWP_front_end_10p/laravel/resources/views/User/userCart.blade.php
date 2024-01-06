@extends('template.main')

@section('content')
    @dump(Session::get('cart'))
    <div class="content" style="margin-top: 1vw; margin-bottom: 1vw; height: auto;">
        <h1 style="text-align: center">Cart</h1>
        <div class="container"
            style="background-color: whitesmoke; margin-top: 1vw; margin-bottom: 1vw; height: auto; padding-top: 1vw; padding-bottom: 1vw; display: flex; flex-direction: column; justify-content: center;">
            @foreach (Session::get('cart') as $c)
                <div class="boxItem"
                    style="margin-right: 1vw; margin-left: 1vw; background-color: aliceblue; width: 100% -2vw; padding-bottom: 1vw; display: flex;  flex-direction: row; margin-bottom: 1vw; margin-top: 1vw;">
                    <div class="imageBox" style="width: 30%; height: 12vw; background-color: blue;">
                        <img src="{{ $c['product']->product_img }}" alt="" style="width: 100%; height: 100%;">
                    </div>
                    <div class="descBox" style="width: 60%; height: 100%; padding-top: 1vw; padding-left: 1vw;">
                        <h5>Nama Barang : {{ $c['product']->product_name }} </h5> <br>
                        <h5>Harga per Item : {{ $c['product']->product_price }}</h5> <br>
                        <h5>Quantity : {{ $c['qty'] }}</h5> <br>
                    </div>
                    <div class="cancelButton" style="width: 10%; height: 100%; background-color: red; text-align: center;">
                        <form action="{{ url('profile/userCart/delete') }}" method="post">
                            @csrf
                            <button class="btn-danger"
                                style="background-color: red; width: 100%; height: 12vw; text-align: center;"
                                name="btnDeleteCart" value="{{ $c['product']->product_id }}">X</button>

                        </form>
                    </div>
                </div>
            @endforeach
            <div class="checkoutButton" style="display: flex; flex-direction: row; justify-content: center;">
                <a href="{{ url('/profile/userCheckout') }}" class="btn btn-info"
                    style="background-color: aliceblue; width: 40vw; border: 1px solid aliceblue; border-radius: 1vw; font-size: 1.5vw">Check
                    Out</a>
            </div>
        </div>
    </div>
@endsection
