@extends('template.profilePage')
@section('konten')
    <div class="col-10 rounded" style="background-color: whitesmoke; height: 30vw; margin-bottom: 2vw;">
        <div class="container" style="margin-top: 2vw; margin-bottom: 2vw; ">
            <div class="store ">
                <img src="{{ asset('assets/category/store.png') }}"
                    style="width: 100px; height: 100px; margin-top: 10vw; margin-left: 45%;" alt="" srcset="">
                <p class="text-center ms-2">Toko Anda Belum di Acc oleh Admin !</p>
            </div>
        </div>
    </div>
@endsection
