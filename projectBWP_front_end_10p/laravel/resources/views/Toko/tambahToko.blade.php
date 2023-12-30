@extends('template.profilePage')
@section('konten')
    <div class="col-10" style="background-color: whitesmoke; height: 25vw; margin-bottom: 2vw;">
        <div class="container">
            <h3 style="margin-top: 1vw;">Buat Toko</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores, exercitationem.</p>
            <form action="" method="post">
                @csrf
                <label style="width: 9vw; margin-top: 2vw;" for="">Nama Toko</label>
                <input type="text" style="width: 20vw;" name="namaToko" id="">
                <br>
                <label style="width: 9vw; margin-top: 2vw;" for="">Email Toko</label>
                <input type="text" style="width: 20vw;" name="email" id="">
                <br>
                <input style="margin-top: 2vw; margin-left: vw;" type="submit" value="Simpan" name="simpan">
            </form>
        </div>
    </div>
@endsection
