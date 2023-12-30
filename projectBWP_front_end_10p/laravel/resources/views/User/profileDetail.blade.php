@extends('template.profilePage')
@section('konten')
    <div class="col-10" style="background-color: whitesmoke; height: 45vw; margin-bottom: 2vw;">
        <div class="container">
            <h3 style="margin-top: 1vw;">Profile Saya </h3>
            <p>Informasi Akun Anda</p>
            <form action="" method="post" style="margin-top: 1vw;">
                @csrf
                <label style="width: 9vw; margin-top: 2vw;" for="">Url Profile Picture</label>
                <input type="text" style="width: 70vw;" name="picture" id="">
                <br>
                <label style="width: 9vw; margin-top: 2vw;" for="">Username</label>
                <input type="text" style="width: 70vw;" name="username" id="">
                <br>
                <label style="width: 9vw; margin-top: 2vw;" for="">Nama</label>
                <input type="text" style="width: 70vw;" name="nama" id="">
                <br>
                <label style="width: 9vw; margin-top: 2vw;" for="">Email</label>
                <input type="email" style="width: 70vw;" name="email" id="">
                <br>
                <label style="width: 9vw; margin-top: 2vw;" for="">Nomor Telepon</label>
                <input type="text" style="width: 70vw;" name="nomortlp" id="">
                <br>
                <label style="width: 9vw; margin-top: 2vw;" for="">Jenis Kelamin</label>
                <select name="jk" style="width: 70vw;" id="">
                    <option value="l">Laki - Laki</option>
                    <option value="p">Perempuan</option>
                    <option value="idk">Lainnya</option>
                </select>
                <br>
                <input style="margin-top: 2vw; margin-left: vw;" type="submit" value="Simpan" name="simpan">
            </form>
        </div>
    </div>
@endsection
