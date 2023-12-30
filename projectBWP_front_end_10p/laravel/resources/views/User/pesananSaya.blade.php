@extends('template.profilePage')

@section('konten')
<div class="col-10" style="background-color: whitesmoke; height: auto; margin-bottom: 2vw;">
    <div class="container" style="display: flex; flex-direction: column; justify-content: center;">
        <h2 style="margin-top: 0.8vw; margin-left: 0.3vw; margin-bottom: 1vw;">Pesanan Saya</h2>
        @for($i = 0; $i < 10; $i++)
            <div class="itemBox" style="width: 56vw; height: 8vw; background-color: red; display: flex; flex-direction: row;padding-top: 0.5vw; margin-bottom: 0.5vw;">
                <div class="itemImageBox" style="width: 12vw; height: 7vw; margin-left: 0.5vw; background-color: #fff; text-align: center; padding-top: 2.5vw;">
                    <h4>Item Image</h4>
                </div>
                <div class="itemDescBox" style="height: 7vw; width: 42.5vw; margin-left: 0.5vw; background-color: #fff; display: flex; flex-direction: column; padding-left: 0.3vw;">
                    <h5><label for="">Nama Barang</label>:</h5>
                    <h5><label for="">Jumlah Barang</label>:</h5>
                    <h5><label for="">Nama Toko</label>:</h5>
                    <h5><label for="">Total Harga</label>:</h5>
                </div>
            </div>
        @endfor
    </div>
</div>
@endsection
