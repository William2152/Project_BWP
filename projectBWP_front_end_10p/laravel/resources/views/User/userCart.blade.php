@extends('template.main')

@section('content')
    <div class="content" style="margin-top: 1vw; margin-bottom: 1vw; height: auto;">
        <h1 style="text-align: center">Cart</h1>
        <div class="container"
            style="background-color: whitesmoke; margin-top: 1vw; margin-bottom: 1vw; height: auto; padding-top: 1vw; padding-bottom: 1vw; display: flex; flex-direction: column; justify-content: center;">
            @for ($i = 0; $i < 10; $i++)
                <div class="boxItem"
                    style="margin-right: 1vw; margin-left: 1vw; background-color: aliceblue; width: 100% -2vw; height: 10vw; display: flex;  flex-direction: row; margin-bottom: 1vw; margin-top: 1vw;">
                    <div class="imageBox" style="width: 30%; height: 100%; background-color: blue;">
                        <img src="{{ asset('assets/ka_store.png') }}" alt="" style="width: 100%; height: 100%;">
                    </div>
                    <div class="descBox" style="width: 60%; height: 100%; padding-top: 1vw; padding-left: 1vw;">
                        <h5>Nama Barang :</h5> <br>
                        <h5>Harga per Item :</h5> <br>
                        <h5>Quantity :</h5> <br>
                    </div>
                    <div class="cancelButton" style="width: 10%; height: 100%; background-color: red; text-align: center;">
                        <form action="" method="post">
                            @csrf
                            <input type="submit" value="X"
                                style="background-color: red; width: 100%; height: 10vw; text-align: center;">
                        </form>
                    </div>
                </div>
            @endfor
            <div class="checkoutButton" style="display: flex; flex-direction: row; justify-content: center;">
                <a href="{{ url('/profile/userCheckout') }}" class="btn btn-info"
                    style="background-color: aliceblue; width: 40vw; border: 1px solid aliceblue; border-radius: 1vw; font-size: 1.5vw">Check
                    Out</a>
            </div>
        </div>
    </div>
@endsection
