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
    <div class="container" style="margin-top: 2vw; padding-bottom: 5vw; background-color: whitesmoke;">
        @if ($errors->any())
            <div class="alert alert-danger">{{ $errors->first() }}</div>
            {{-- @foreach ($errors->all() as $pesanError)
                    @endforeach --}}
        @elseif (Session::has('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>
        @elseif (Session::has('err'))
            <div class="alert alert-danger">{{ Session::get('err') }}</div>
        @endif
        <div class="content" style="margin-top: 2vw; margin-left: 1vw;">
            <div class="row">
                <div class="col-4">
                    <img src="{{ $product->product_img == null ? '/Carousel2.jpg' : $product->product_img }}"
                        style="height: 100%; width: 100%; margin-top: 2vw;" alt="">
                </div>
                <div class="col-8">
                    <h4 style="margin-top: 2vw;">{{ $product->product_name }}</h4>
                    <p>Rating : 5 | 100 Penilaian | 100 Terjual</p>
                    <br>
                    <h1 id="totalHarga">${{ $product->product_price }}</h1>
                    <p class="fw-bold">Stok : {{ $product->product_stock }}</p>
                    <div class="col">
                        <p>Kuantitas </p>
                        <form action="{{ url('/profile/userCart/add') }}" method="post">
                            @csrf
                            <div class="quantity-selector">
                                <div class="quantity-button" onclick="updateQuantity(-1)">-</div>
                                <input type="text" name="qty" class="quantity-input" id="quantity" value="1">
                                <div class="quantity-button" onclick="updateQuantity(1)">+</div>
                            </div>

                            <script>
                                var minQuantity = 1;
                                var maxQuantity = <?php echo $product->product_stock; ?>;
                                var price = <?php echo $product->product_price; ?>;


                                function updateQuantity(change) {
                                    var quantityInput = document.getElementById('quantity');
                                    var currentQuantity = parseInt(quantityInput.value, 10);

                                    var newQuantity = Math.min(Math.max(minQuantity, currentQuantity + change), maxQuantity);

                                    var priceTotal = price * newQuantity;

                                    quantityInput.value = newQuantity;
                                    document.getElementById('totalHarga').textContent = 'Rp' + priceTotal;
                                }
                            </script>

                            <br>

                            <button class="btn btn-primary" name="btnAddCart" value="{{ $product->product_id }}">Add To
                                Cart</button>
                            <button class="btn btn-success" name="btnBuyNow" value="{{ $product->product_id }}">Buy
                                Now</button>
                            <a href="{{ url('profile/userCart') }}" class="btn btn-warning">Keranjang saya</a>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('toko')
    <div class="container" style="margin-top: 2vw; background-color: whitesmoke; height: 13vw; margin-bottom: 2vw;">
        <div class="content">
            <div class="row">
                <div class="tokoMiniProfileBox" style="width: 30vw; height: 10vw; display: flex; flex-direction: row;">
                    <div class="tokoMiniProfileBox1" style="padding-left: 1vw; padding-top: 2.5vw;">
                        <img src="{{ $toko->store_img == null ? asset('assets/category/store.png') : $toko->store_img }}"
                            alt="" style="border-radius: 50%; width: 5vw; height: 5vw;">
                    </div>
                    <div class="tokoMiniProfileBox2" style="margin-left: 2vw; padding-top: 2vw;">
                        <h4 style="text-align:">{{ $toko->store_name }}</h4>
                        <h6 style="font-style: oblique; color: gray">Online</h6>
                        <form action="{{ url('/liattoko/chattoko/' . $toko->store_id) }}"  method="post">
                            @csrf
                            <input type="submit" value="Chat Sekarang" name="btnChat" class="btn btn-primary">
                        </form>
                        <form action="{{ url('/liattoko/produk/' . $toko->store_id) }}" method="post">
                            @csrf
                            <input type="submit" value="Kunjungi Toko" name="btnKunjungi">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('spec')
    <div class="container"
        style="margin-top: 2vw; background-color: whitesmoke; height: auto; margin-bottom: 2vw; padding-bottom: 1vw; padding-left: 1vw;">
        <h3 style="padding-top: 1vw; margin-bottom: 1vw;">Spesifikasi Product</h3>
        <h5>Kategori : Lorem ipsum dolor sit amet.</h5>
        <h5>Merek : Lorem ipsum dolor sit amet.</h5>
        <h5>Kapasitas : Lorem ipsum dolor sit amet.</h5>
        <h5>Masa Garansi : Lorem ipsum dolor sit amet.</h5>
        <h5>Dikirim dari : Lorem ipsum dolor sit amet.</h5>
    </div>
@endsection

@section('detail')
    <div class="container"
        style="margin-top: 2vw; background-color: whitesmoke; height: auto; margin-bottom: 2vw; padding-bottom: 1vw; padding-left: 1vw;">
        <h3 style="padding-top: 1vw; margin-bottom: 1vw;">Spesifikasi Product</h3>
        <p>{{ $product->product_detail }}</p>
    </div>
@endsection
