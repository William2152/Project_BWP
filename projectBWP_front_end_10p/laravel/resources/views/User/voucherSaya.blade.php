@extends('template.profilePage')

@section('konten')
<div class="col-10" style="background-color: whitesmoke; height: auto; margin-bottom: 2vw;">
    <div class="container" style="display: flex; flex-direction: column; justify-content: center;">
        <h2 style="margin-top: 0.8vw; margin-left: 0.3vw; margin-bottom: 1vw;">Voucher Saya</h2>
        @for($i = 0; $i < 10; $i++)
            <div class="voucherBoxContainer" style="display: flex; flex-direction: row; margin-bottom: 1vw;">
                <div class="voucherBox" style="display: flex; flex-direction: row; width: 27vw; height: 5vw; background-color: red; padding-left: 0.5vw; padding-top: 0.5vw;">
                    <div class="voucherImage" style="width: 7vw; height: 4vw; background-color: #fff; text-align: center; padding-top: 1.5vw;">
                        <h6>Image</h6>
                    </div>
                    <div class="voucherDesc" style="width: 18.5vw; height: 4vw; background-color: #fff; text-align: left; padding-top: 0.5vw; margin-left: 0.5vw; padding-left: 0.5vw;">
                        <h6>Judul Voucher :</h6>
                        <h6>Expired Date :</h6>
                    </div>
                </div>
                <div class="voucherBox" style="display: flex; flex-direction: row; width: 27vw; height: 5vw; background-color: red; padding-left: 0.5vw; padding-top: 0.5vw; margin-left: 2.5vw;">
                    <div class="voucherImage" style="width: 7vw; height: 4vw; background-color: #fff; text-align: center; padding-top: 1.5vw;">
                        <h6>Image</h6>
                    </div>
                    <div class="voucherDesc" style="width: 18.5vw; height: 4vw; background-color: #fff; text-align: left; padding-top: 0.5vw; margin-left: 0.5vw; padding-left: 0.5vw;">
                        <h6>Judul Voucher :</h6>
                        <h6>Expired Date :</h6>
                    </div>
                </div>
            </div>
        @endfor
    </div>
</div>
@endsection
