@extends('template.profilePage')

@section('konten')
    <div class="col-10" style="background-color: whitesmoke; height: auto; margin-bottom: 2vw;">
        @if ($errors->any())
            <div class="alert alert-danger mb-4">{{ $errors->first() }}</div>
            {{-- @foreach ($errors->all() as $pesanError)
                    @endforeach --}}
        @elseif (Session::has('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>
        @elseif (Session::has('err'))
            <div class="alert alert-danger">{{ Session::get('err') }}</div>
        @endif
        <div class="container" style="display: flex; flex-direction: column; justify-content: center;">
            <h2 style="margin-top: 0.8vw; margin-left: 0.3vw; margin-bottom: 1vw;">Saldo Saya</h2>
            <h5>Saldo : Rp. {{ $curr->user_money }}</h5>
            <form action="{{ url('profile/reqTopup') }}" method="post">
                @csrf
                <input type="number" name="topup_saldo" id="" placeholder="Amount">
                <button class="btn btn-primary" name="btnTopup">Topup</button>
                <br>
                <p style="font-style: oblique; color: gray">*Proses Top Up menunggu approve dari Admin agar saldo dapat
                    masuk ke account user.</p>
            </form>
        </div>
    </div>
@endsection
