@extends('template.profilePage')
@section('konten')
    <div class="col-10" style="background-color: whitesmoke; height: 25vw; margin-bottom: 2vw;">
        @if ($errors->any())
            <div class="alert alert-danger mb-4">{{ $errors->first() }}</div>
            {{-- @foreach ($errors->all() as $pesanError)
                    @endforeach --}}
        @elseif (Session::has('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>
        @elseif (Session::has('err'))
            <div class="alert alert-danger">{{ Session::get('err') }}</div>
        @endif
        <div class="container">
            <h3 style="margin-top: 1vw;">Ubah Password</h3>
            <p>Ubah Password Anda</p>
            <form action="{{ url('profile/ubahPass') }}" method="post">
                @csrf
                <label style="width: 9vw; margin-top: 2vw;" for="">Password Lama</label>
                <input type="password" style="width: 20vw;" name="oldpw" id="">
                <br>
                <label style="width: 9vw; margin-top: 2vw;" for="">Password Baru</label>
                <input type="password" style="width: 20vw;" name="newpw" id="">
                <br>
                <label style="width: 9vw; margin-top: 2vw;" for="">Confirm Password</label>
                <input type="password" style="width: 20vw;" name="confirmnewpw" id="">
                <br>
                <input style="margin-top: 2vw; margin-left: vw;" type="submit" value="Simpan" name="simpan">
            </form>
        </div>
    </div>
@endsection
