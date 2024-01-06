@extends('template.Admin')

@section('isimenu')
    <div class="isi ps-3" style="margin-top: 1vw; background-color: whitesmoke; height: 48vw;">
        @if ($errors->any())
            <div class="alert alert-danger">{{ $errors->first() }}</div>
            {{-- @foreach ($errors->all() as $pesanError)
                    @endforeach --}}
        @elseif (Session::has('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>
        @elseif (Session::has('err'))
            <div class="alert alert-danger">{{ Session::get('err') }}</div>
        @endif
        <form action="{{ url('/admin/voucher/add') }}" method="post">
            @csrf
            <label style="width: 9vw; margin-top: 2vw;" for="">Nama Voucher</label>:
            <input type="text" style="width: 70vw;" name="voucher_name" id="">
            <br>
            <label style="width: 9vw; margin-top: 2vw;" for="">Potongan</label>:
            {{-- <input type="text" style="width: 70vw;" name="voucher_discount" id=""> --}}
            <select name="voucher_discount" style="width: 70vw;" id="">
                <option value="25">25%</option>
                <option value="30">30%</option>
                <option value="50">50%</option>
                <option value="70">70%</option>
            </select>
            <br>
            {{-- <label style="width: 9vw; margin-top: 2vw;" for="">Gambar Voucher</label>:
            <select name="voucher_image" style="width: 70vw;" id="">
                <option value="">25%</option>
                <option value="">30%</option>
                <option value="">50%</option>
                <option value="">70%</option>
            </select>
            <br> --}}
            <label style="width: 9vw; margin-top: 2vw;" for="">Voucher expired</label>:
            <input type="datetime-local" style="width: 70vw;" name="voucher_expired" id="">
            <button class="btn btn-primary" name="btnBuat" style="margin-top: 2vw;">Buat</button>
        </form>
    </div>
@endsection
