@extends('template.main')
<style>
    .quantity-selector {
        display: flex;
        align-items: center;
    }

    .quantity-input {
        width: 40px;
        text-align: center;
        margin: 0 10px;
    }

    .quantity-button {
        cursor: pointer;
        font-size: 1.2em;
        user-select: none;
    }
</style>
@section('content')
    <div class="container" style="margin-top: 2vw; background-color: whitesmoke; height: 30vw;">
        <div class="content" style="margin-top: 2vw; margin-left: 1vw;">
            <div class="row">
                <div class="col-4">
                    <img src="/Carousel2.jpg" style="height: 100%; width: 100%; margin-top: 2vw;" alt="">
                </div>
                <div class="col-8">
                    <h4 style="margin-top: 2vw;">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ex, a.</h4>
                    <p>Rating : 5 | 100 Penilaian | 100 Terjual</p>
                    <br>
                    <h1>Rp100.000</h1>
                    <p>Pengiriman ke : </p>
                    <p>Ongkos Kirim : </p>
                    <div class="col">
                        <p>Kuantitas </p>
                        <div class="quantity-selector">
                            <div class="quantity-button" onclick="updateQuantity(-1)">-</div>
                            <input type="text" class="quantity-input" id="quantity" value="1">
                            <div class="quantity-button" onclick="updateQuantity(1)">+</div>
                            <p style="margin-left: 1vw; text-align: center;"> tersisa 1000 buah</p>
                        </div>

                        <script>
                            function updateQuantity(change) {
                                var quantityInput = document.getElementById('quantity');
                                var currentQuantity = parseInt(quantityInput.value, 10);

                                var newQuantity = Math.max(1, currentQuantity + change);

                                quantityInput.value = newQuantity;
                            }
                        </script>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('toko')
    <div class="container" style="margin-top: 2vw; background-color: whitesmoke; height: 10vw;">
        <div class="content">
            <div class="row">
                <div class="col-3">
                    <img src="" alt="" style="">
                </div>
            </div>
        </div>
    </div>
@endsection
