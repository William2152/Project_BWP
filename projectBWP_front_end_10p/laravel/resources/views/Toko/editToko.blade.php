@extends('template.punyaToko')
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
    <h1 style="text-align: center; margin-bottom: 1vw;">Edit Toko</h1>
    <div class="container" style="border: 2px solid black; margin-bottom: 2vw; padding-bottom: 2vw;">
        <form action="{{ url('/tokosaya/ubahtoko') }}" method="post">
            @csrf
            <label style="width: 9vw; margin-top: 2vw;" for="">Nama Toko</label>:
            <input type="text" style="width: 20vw;" name="namaToko" id="">
            <br>
            <label style="width: 9vw; margin-top: 2vw;" for="">Email Toko</label>:
            <input type="text" style="width: 20vw;" name="email" id="">
            <br>
            <label style="width: 9vw; margin-top: 2vw;" for="">Alamat Toko</label>:
            <input type="text" style="width: 20vw;" name="alamat" id="">
            <br>
            <label style="width: 9vw; margin-top: 2vw;" for="">URL Logo Toko</label>:
            <input type="text" style="width: 20vw;" name="urlLogoToko" id="">
            <br>
            <input style="margin-top: 2vw; margin-left: vw;" type="submit" value="Simpan" name="simpan">
        </form>
    </div>
@endsection
