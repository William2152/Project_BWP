@extends('template.punyatoko')
@section('content')
    <div class="content" style="background-color: whitesmoke; padding-bottom: 2vw;">
        <div class="container">
            @if ($errors->any())
                <div class="alert alert-danger mb-4">{{ $errors->first() }}</div>
                {{-- @foreach ($errors->all() as $pesanError)
            @endforeach --}}
            @elseif (Session::has('success'))
                <div class="alert alert-success">{{ Session::get('success') }}</div>
            @elseif (Session::has('err'))
                <div class="alert alert-danger">{{ Session::get('err') }}</div>
            @endif
            <div class="isi ms-2">
                <form action="{{ url('tokosaya/addProduct') }}" method="post">
                    @csrf
                    <label style="width: 9vw; margin-top: 2vw;" for="">Url Item Picture</label>
                    <input type="text" style="width: 70vw;" name="product_img" id=""
                        value="{{ old('product_img', '') }}">
                    <br>
                    <label style="width: 9vw; margin-top: 2vw;" for="">Nama</label>
                    <input type="text" style="width: 70vw;" name="product_name" id=""
                        value="{{ old('product_name', '') }}">
                    <br>
                    <label style="width: 9vw; margin-top: 2vw;" for="">Harga</label>
                    <input type="number" style="width: 70vw;" name="product_price" id=""
                        value="{{ old('product_price', '') }}">
                    <br>
                    <label style="width: 9vw; margin-top: 2vw;" for="">Jumlah</label>
                    <input type="number" style="width: 70vw;" name="product_stock" id=""
                        value="{{ old('product_stock', '') }}">
                    <br>
                    <label style="width: 9vw; margin-top: 2vw;" for="">Kategori Barang</label>
                    <select name="category_id" id="" style="width: 70vw;">
                        @foreach ($category as $c)
                            <option value="{{ $c->category_id }}">{{ $c->category_name }}</option>
                        @endforeach
                    </select>
                    <br>
                    <label style="width: 9vw; margin-top: 2vw;" for="">Deskripsi Produk</label>
                    <textarea name="product_detail" id="" cols="143" rows="10" style="margin-top: 1vw;"
                        value="{{ old('product_detail', '') }}"></textarea>
                    <br>
                    <button class="btn btn-primary" name="btnSubmit" style="margin-top: 2vw; margin-left: 75vw;"
                        value="Submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
