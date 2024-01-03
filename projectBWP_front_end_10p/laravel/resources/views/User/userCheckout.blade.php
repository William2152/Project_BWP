@extends('template.main')

@section('content')
    <div class="content" style="height: auto; background-color: rgba(33, 33, 150, 0.753); padding-top: 1.5vw; padding-bottom: 1.5vw;">
        <h1 style="text-align: center; color: aliceblue">Check Out</h1>
        <div class="container" style="background-color: whitesmoke; margin-top: 1vw; margin-bottom: 1vw; height: auto; padding-top: 1vw; padding-bottom: 1vw; display: flex; flex-direction: column; justify-content: center;">
            @for ($i = 0; $i < 3; $i++)
                <div class="boxItem" style="margin-right: 1vw; margin-left: 1vw; background-color: aliceblue; width: 100% -2vw; height: 10vw; display: flex;  flex-direction: row; margin-bottom: 1vw; margin-top: 1vw;">
                    <div class="imageBox" style="width: 30%; height: 100%; background-color: blue;">
                        <img src="{{asset('assets/ka_store.png')}}" alt="" style="width: 100%; height: 100%;">
                    </div>
                    <div class="descBox" style="width: 60%; height: 100%; padding-top: 1vw; padding-left: 1vw;">
                        <h5>Nama Barang :</h5> <br>
                        <h5>Quantity :</h5> <br>
                        <h5>Rp. 100,000</h5>
                    </div>
                </div>
            @endfor
            <h2 style="text-align: right; margin-right: 1vw;">Total (3 menu) : Rp 300,000</h2>
        </div>

        <div class="container" style="background-color:whitesmoke; padding-top: 1vw; padding-bottom: 1vw; margin-bottom: 1vw;">
            <h2>Alamat User</h2>
            <p>Jalan Entah Kemana No. 99</p>
        </div>

        <div class="container" style="background-color:whitesmoke; padding-top: 1vw; padding-bottom: 1vw; margin-bottom: 1vw;">
            <h2>Discount</h2>
            <form action="">
                @csrf
                <input type="button" value="Pilih Voucher">
            </form>
        </div>

        <div class="container" style="background-color:whitesmoke; padding-top: 1vw; padding-bottom: 1vw; margin-bottom: 1vw;">
            <h2>Payment</h2>
            <form action="">
                @csrf
                <input type="button" value="Pilih Metode Pembayaran">
            </form>
        </div>

        <div class="container" style="background-color: whitesmoke; padding-top: 1vw; padding-bottom: 1vw; margin-bottom: 1vw;">
            <h2>Opsi Pengiriman</h2>
            <p>___________________________________________________________________________________________________________________________________________________________________________________________________</p>
            <form action="" method="post">
                @csrf
                <input type="radio" name="regular" id=""> Reguler
                <input type="radio" name="hemat" id="" style="margin-left: 3vw;"> Hemat
            </form>
        </div>

        <div class="container" style="background-color:whitesmoke; padding-top: 1vw; padding-bottom: 1vw; margin-bottom: 1vw; display: flex; flex-direction: column">
            <h2>Rincian Pembayaran</h2>
            <table>
                <tr>
                    <th>Subtotal untuk Product :</th>
                    <td><span>Rp. 300,000</span></td>
                </tr>
                <tr>
                    <th>Subtotal untuk Pengiriman :</th>
                    <td><span>Rp. 9,000</span></td>
                </tr>
                <tr>
                    <th>Total Discount Pengiriman :</th>
                    <td><span>Rp. 0</span></td>
                </tr>
                <tr>
                    <th>Biaya Layanan :</th>
                    <td><span>Rp. 1,000</span></td>
                </tr>
                <tr>
                    <th>Biaya Penanganan :</th>
                    <td><span>Rp. 1,000</span></td>
                </tr>
                <tr>
                    <th><h4>Total Pembayaran</h4></th>
                    <td><span><h4>Rp. 311,000</h4></span></td>
                </tr>
            </table>
            <form action="" method="post" style="text-align: right">
                @csrf
                <br>
                <input type="button" value="Buat Pesanan" style="width: 10vw; height: 2vw; border-radius: 1vw; border: 0px solid black; color: white; background-color: rgba(33, 33, 150, 0.753);">
            </form>
        </div>
    </div>
@endsection
