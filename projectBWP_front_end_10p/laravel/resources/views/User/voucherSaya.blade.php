@extends('template.profilePage')

@section('konten')
    <div class="col-10" style="background-color: whitesmoke; height: auto; margin-bottom: 2vw;">
        <div class="container" style="display: flex; flex-direction: column; justify-content: center;">
            <h2 style="margin-top: 0.8vw; margin-left: 0.3vw; margin-bottom: 1vw;">Voucher Saya</h2>
            @foreach ($voucher as $v)
                <div class="container mt-5" style="background-color: cyan; height: 22vh; margin-bottom: 2vh;">
                    <div class="row">
                        <div class="col-md-2">
                            <img src="{{ url('/assets/voucher/' . $v->voucher_img) }}"
                                style="width: 20vh; height: 20vh; margin-top: 1vh;" class="img-fluid" alt="Voucher Image">
                        </div>

                        <div class="col-md-4" style="padding-top: 1vh;">
                            <h3>{{ $v->voucher_nama }}</h3>
                            <p><strong>Expired Date:</strong> {{ $v->voucher_tgl_berlaku }}</p>
                            <a href="{{ url('/homePage') }}" class="btn btn-primary">Gunakan Voucher</a>
                        </div>
                        <div class="col-md-6" style="padding-top: 10vh;">
                            <p><strong>Syarat & Ketentuan Berlaku</strong></p>
                            <p>Pembayaran Wajib Menggunakan Saldo</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
