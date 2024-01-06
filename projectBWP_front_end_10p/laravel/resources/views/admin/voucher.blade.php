@extends('template.Admin')

@section('isimenu')
    <div class="isi" style="margin-top: 1vw; background-color: whitesmoke; height: 48vw;">
        <form action="" method="post">
            @csrf
            <label style="width: 9vw; margin-top: 2vw;" for="">Nama Voucher</label>:
            <input type="text" style="width: 70vw;" name="voucher_name" id="">
            <br>
            <label style="width: 9vw; margin-top: 2vw;" for="">Potongan</label>:
            <input type="text" style="width: 70vw;" name="voucher_discount" id="">
            <br>
            <label style="width: 9vw; margin-top: 2vw;" for="">Gambar Voucher</label>:
            <select name="voucher_image" style="width: 70vw;" id="">
                <option value="">25%</option>
                <option value="">30%</option>
                <option value="">50%</option>
                <option value="">70%</option>
            </select>
            <br>
            <label style="width: 9vw; margin-top: 2vw;" for="">Voucher expired</label>:
            <input type="datetime-local" style="width: 70vw;" name="voucher_expired" id="">
            <br>
            <input type="submit" value="Buat" name="buat" style="margin-top: 1vw; width: 5vw;">
        </form>
    </div>
@endsection
