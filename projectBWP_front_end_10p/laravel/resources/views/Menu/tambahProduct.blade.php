@extends('template.punyatoko')
@section('content')
    <div class="content" style="background-color: whitesmoke; padding-bottom: 2vw;">
        <div class="container">
            <div class="isi ms-2">
                <form action="" method="post">
                    @csrf
                    <label style="width: 9vw; margin-top: 2vw;" for="">Url Item Picture</label>
                    <input type="text" style="width: 70vw;" name="picture" id="">
                    <br>
                    <label style="width: 9vw; margin-top: 2vw;" for="">Nama</label>
                    <input type="text" style="width: 70vw;" name="username" id="">
                    <br>
                    <label style="width: 9vw; margin-top: 2vw;" for="">Merek</label>
                    <input type="text" style="width: 70vw;" name="nama" id="">
                    <br>
                    <label style="width: 9vw; margin-top: 2vw;" for="">Jumlah</label>
                    <input type="email" style="width: 70vw;" name="email" id="">
                    <br>
                    <label style="width: 9vw; margin-top: 2vw;" for="">Deskripsi Produk</label>
                    <textarea name="deskripsi" id="" cols="143" rows="10" style="margin-top: 1vw;"></textarea>
                    <br>
                    <input type="submit" value="Submit" name="submit" style="margin-top: 2vw; margin-left: 75vw;">
                </form>
            </div>
        </div>
    </div>
@endsection
