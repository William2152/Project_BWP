@extends('template.profilePage')

@section('konten')
<div class="col-10" style="background-color: whitesmoke; height: auto; margin-bottom: 2vw;">
    <div class="container" style="display: flex; flex-direction: column; justify-content: center;">
        <h2 style="margin-top: 0.8vw; margin-left: 0.3vw; margin-bottom: 1vw;">Saldo Saya</h2>
        <h5>Saldo : Rp. 0</h5>
        <form action="" method="post">
            @csrf
            <input type="text" name="" id="" placeholder="Amount"> <input type="submit" value="Top Up"> <br>
            <p style="font-style: oblique; color: gray">*Proses Top Up menunggu approve dari Admin agar saldo dapat masuk ke account user.</p>
        </form>
    </div>
</div>
@endsection
