@extends('template.profilePage')
@section('konten')
    <div class="col-10 rounded" style="background-color: whitesmoke; height: 30vw; margin-bottom: 2vw;">
        <div class="container" style="margin-top: 2vw; margin-bottom: 2vw; ">
            <div class="store ">
                <img src="/store.png" style="width: 100px; height: 100px; margin-top: 10vw; margin-left: 45%;" alt=""
                    srcset="">
                <p class="text-center ms-2">Anda Belum Memiliki Toko Silahkan Membuat Toko Terlebih Dahulu !</p>

                <a href="{{ url('/profile/formtoko') }}" class="btn btn-primary text-light" name="btnCreate"
                    style="margin-left: 45%;">Buat Toko</a>


            </div>
        </div>
    </div>
@endsection
