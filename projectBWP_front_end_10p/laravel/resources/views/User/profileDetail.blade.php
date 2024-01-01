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
        <div class="container">

            <h3 style="margin-top: 1vw;">Profile Saya </h3>
            <p>Informasi Akun Anda</p>
            <form action="{{ url('profile/ubahProfile') }}" method="post" style="margin-top: 1vw;">
                @csrf
                <label style="width: 9vw; margin-top: 1vw;" for="">Url Profile Picture</label>
                <input type="text" class="form-control" style="width: 70vw;" name="user_img" id=""
                    value="{{ old('user_img') }}">

                <label style="width: 9vw; margin-top: 1vw;" for="">Username</label>
                <input type="text" class="form-control" style="width: 70vw;" name="user_name" id=""
                    value="{{ old('user_name') }}">

                <label style="width: 9vw; margin-top: 1vw;" for="">Nama</label>
                <input type="text" class="form-control" style="width: 70vw;" name="user_nama" id=""
                    value="{{ old('user_nama') }}">

                <label style="width: 9vw; margin-top: 1vw;" for="">Email</label>
                <input type="email" class="form-control" style="width: 70vw;" name="user_email" id=""
                    value="{{ old('user_email') }}">

                <label style="width: 9vw; margin-top: 1vw;" for="">Nomor Telepon</label>
                <input type="text" class="form-control" style="width: 70vw;" name="user_phone" id=""
                    value="{{ old('user_phone') }}">

                <label style="width: 9vw; margin-top: 1vw;" for="">Jenis Kelamin</label>
                <select name="user_gender" class="form-select" style="width: 70vw;" id="">
                    <option value="P">Laki - Laki</option>
                    <option value="W">Perempuan</option>
                    <option value="L">Lainnya</option>
                </select>

                <input class="btn btn-success" style="margin-top: 2vw; margin-left: vw;" type="submit" value="Simpan"
                    name="simpan">
            </form>
        </div>
    </div>
@endsection
