@extends('template.punyatoko')

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
    @if ($errors->any())
        <div class="alert alert-danger mb-4">{{ $errors->first() }}</div>
        {{-- @foreach ($errors->all() as $pesanError)
            @endforeach --}}
    @elseif (Session::has('success'))
        <div class="alert alert-success">{{ Session::get('success') }}</div>
    @elseif (Session::has('err'))
        <div class="alert alert-danger">{{ Session::get('err') }}</div>
    @endif
    <div class="container" style="margin-top: 2vw; background-color: whitesmoke; height: 45vw;">
        <div class="content" style="margin-top: 2vw; margin-left: 1vw;">
            <div class="row">
                <div class="col-4">
                    <img src="{{ $product->product_img == null ? '/Carousel2.jpg' : $product->product_img }}"
                        style="height: 100%; width: 100%; margin-top: 2vw;" alt="">
                </div>
                <div class="col-8">
                    <form action="{{ url('tokosaya/edit/request') }}" method="post">
                        @csrf
                        <input type="text" style="width: 20vw;" name="id" value="{{ $product->product_id }}"
                            id="" hidden>
                        <label style="width: 9vw; margin-top: 2vw;" for="">Url Image</label>:
                        <input type="text" style="width: 20vw;" value="{{ $product->product_img }}" name="product_img"
                            id="">
                        <br>
                        <label style="width: 9vw; margin-top: 2vw;" for="">Nama Barang</label>:
                        <input type="text" style="width: 20vw;" value="{{ $product->product_name }}" name="product_name"
                            id="">
                        <br>
                        <label style="width: 9vw; margin-top: 2vw;" for="">Harga</label>:
                        <input type="text" style="width: 20vw;" value="{{ $product->product_price }}"
                            name="product_price" id="">
                        <br>
                        <label style="width: 9vw; margin-top: 2vw;" for="">jumlah</label>:
                        <input type="text" style="width: 20vw;" value="{{ $product->product_stock }}"
                            name="product_stock" id="">
                        <br>
                        <label style="width: 9vw; margin-top: 2vw;" for="">Kategori Barang</label>
                        <select name="category_id" id="" style="width: 20vw;">
                            @foreach ($category as $c)
                                <option value="{{ $c->category_id }}">{{ $c->category_name }}</option>
                            @endforeach
                        </select>
                        <br>
                        <label style="width: 9vw; margin-top: 2vw;" for="">Deskripsi Produk</label>:
                        <textarea style="margin-top: 2vw;" name="product_detail" id="" cols="40" rows="10"> {{ $product->product_detail }}</textarea>
                        <br>
                        <input style="margin-top: 2vw; margin-left: vw;" type="submit" value="Simpan" name="simpan">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
