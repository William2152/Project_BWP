@extends('template.profilePage')
@section('konten')
    <div class="col-10" style="background-color: whitesmoke; height: 45vw; margin-bottom: 2vw;">
        @if ($errors->any())
            <div class="alert alert-danger mb-4">{{ $errors->first() }}</div>
            {{-- @foreach ($errors->all() as $pesanError)
                @endforeach --}}
        @elseif (Session::has('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>
        @elseif (Session::has('err'))
            <div class="alert alert-danger">{{ Session::get('err') }}</div>
        @endif
        <div class="col-10" style="background-color: whitesmoke; height: 25vw; margin-bottom: 2vw;">
            <div class="container">
                <h3 style="margin-top: 1vw;">Buat Toko</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores, exercitationem.</p>
                <form action="{{ url('/profile/tambahtoko') }}" method="post">
                    @csrf
                    <label style="width: 9vw; margin-top: 2vw;" for="">Nama Toko</label>
                    <input type="text" style="width: 20vw;" name="namaToko" id="">
                    <br>
                    <label style="width: 9vw; margin-top: 2vw;" for="">Email Toko</label>
                    <input type="text" style="width: 20vw;" name="email" id="">
                    <br>
                    <label style="width: 9vw; margin-top: 2vw;" for="">Alamat Toko</label>
                    <input type="text" style="width: 20vw;" name="alamat" id="">
                    <br>
                    <input style="margin-top: 2vw; margin-left: vw;" type="submit" value="Simpan" name="simpan">
                </form>
            </div>
        </div>
    @endsection
