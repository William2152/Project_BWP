@extends('template.punyaToko')
@section('content')
    <h1 style="text-align: center; margin-bottom: 1vw;">Edit Toko</h1>
    <div class="container" style="border: 2px solid black; margin-bottom: 2vw; padding-bottom: 2vw;">
        <form action="" method="post">
            @csrf
            <label style="width: 9vw; margin-top: 2vw;" for="">Nama Toko</label>:
            <input type="text" style="width: 20vw;" name="namaToko" id="">
            <br>
            <label style="width: 9vw; margin-top: 2vw;" for="">Deskripsi Toko</label>:
            <input type="text" style="width: 20vw;" name="deskripsiToko" id="">
            <br>
            <label style="width: 9vw; margin-top: 2vw;" for="">URL Logo Toko</label>:
            <input type="text" style="width: 20vw;" name="urlLogoToko" id="">
            <br>
            <input style="margin-top: 2vw; margin-left: vw;" type="submit" value="Simpan" name="simpan">
        </form>
    </div>
@endsection
