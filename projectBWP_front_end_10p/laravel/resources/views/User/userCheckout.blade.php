@extends('template.main')

@section('content')
    <div class="content"
        style="height: auto; background-color: rgba(33, 33, 150, 0.753); padding-top: 1.5vw; padding-bottom: 1.5vw;">
        <div class="d-flex justify-content-between align-items-center">
            <a href="{{ url('profile/userCart') }}" class=" btn btn-danger ms-2">Back</a>
            <h1 style="color: aliceblue">Check Out</h1>
            <div class=""></div>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">{{ $errors->first() }}</div>
            {{-- @foreach ($errors->all() as $pesanError)
                    @endforeach --}}
        @elseif (Session::has('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>
        @elseif (Session::has('err'))
            <div class="alert alert-danger">{{ Session::get('err') }}</div>
        @endif

        <div class="container"
            style="background-color: whitesmoke; margin-top: 1vw; margin-bottom: 1vw; height: auto; padding-top: 1vw; padding-bottom: 1vw; display: flex; flex-direction: column; justify-content: center;">
            @foreach ($items as $c)
                <div class="boxItem"
                    style="margin-right: 1vw; margin-left: 1vw; background-color: aliceblue; width: 100% -2vw; padding-bottom: 1vw; display: flex;  flex-direction: row; margin-bottom: 1vw; margin-top: 1vw;">
                    <div class="imageBox" style="width: 30%; height: 17vw;">
                        <img src="{{ $c['product']->product_img }}" alt="" style="width: 17vw; height: 17vw;">
                    </div>
                    <div class="descBox" style="width: 60%; height: 100%; padding-top: 4vw; padding-left: 1vw;">
                        <h5>Nama Barang : {{ $c['product']->product_name }} </h5> <br>
                        <h5>Harga per Item : {{ $c['product']->product_price }}</h5> <br>
                        <h5>Quantity : {{ $c['qty'] }}</h5> <br>
                    </div>
                </div>
            @endforeach
            <h2 style="text-align: right; margin-right: 1vw;">Total ({{ count($items) }} menu) : $
                {{ number_format($total, 0, '.', ',') }}</h2>
        </div>

        <form action="{{ url('/profile/prosesCheckout') }}" method="post">
            @csrf
            <div class="container"
                style="background-color:whitesmoke; padding-top: 1vw; padding-bottom: 1vw; margin-bottom: 1vw;">
                <h2>Alamat Pengiriman</h2>
                <input type="text" class="form-control" name="order_destination" id="">
            </div>

            <div class="container"
                style="background-color:whitesmoke; padding-top: 1vw; padding-bottom: 1vw; margin-bottom: 1vw;">
                <h2>Discount</h2>
                <select name="order_disc" id="order_disc" class="form-select">
                    <option disabled hidden selected value="NULL">Voucher</option>
                    @foreach ($voucher as $v)
                        <option value="{{ $v->voucher_id }}" data-potongan="{{ $v->voucher_potongan }}" data-namaVoucher="{{ $v->voucher_nama }}">
                            Voucher : {{ $v->voucher_nama }}, Potongan : {{ $v->voucher_potongan }}%
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- <div class="container"
                style="background-color:whitesmoke; padding-top: 1vw; padding-bottom: 1vw; margin-bottom: 1vw;">
                <h2>Payment</h2>
                <form action="">
                    @csrf
                    <input type="button" value="Pilih Metode Pembayaran">
                </form>
            </div> --}}

            {{-- <div class="container"
                style="background-color: whitesmoke; padding-top: 1vw; padding-bottom: 1vw; margin-bottom: 1vw;">
                <h2>Opsi Pengiriman</h2>
                <p>___________________________________________________________________________________________________________________________________________________________________________________________________
                </p>
                <form action="" method="post">
                    @csrf
                    <input type="radio" name="regular" id=""> Reguler
                    <input type="radio" name="hemat" id="" style="margin-left: 3vw;"> Hemat
                </form>
            </div> --}}

            <div class="container"
                style="background-color:whitesmoke; padding-top: 1vw; padding-bottom: 1vw; margin-bottom: 1vw; display: flex; flex-direction: column">
                <h2>Rincian Pembayaran</h2>
                <table>
                    <tr>
                        <th>Subtotal untuk Product :</th>
                        <td><span id="productSubtotal">$ {{ number_format($total, 0, '.', ',') }}</span></td>
                    </tr>
                    <tr>
                        <th>Total Discount :</th>
                        <td><span id="totalDiscount">$ -</span></td>
                    </tr>
                    <tr>
                        <th>Voucher :</th>
                        <td><b id="voucherValue">-</b></td>
                    </tr>
                    <tr>
                        <th>
                            <h4>Total Pembayaran</h4>
                        </th>
                        <td>
                            <span>
                                <h4 id="grandTotal"><b>$ -</b></h4>
                            </span>
                        </td>
                    </tr>
                </table>

                {{-- <script>
                    function changeGrandTotal() {
                        var selectedValue = document.getElementById("order_disc").value;
                        var grandTotal = <?php hitungGrandTotal(selectedValue); ?>

                        // Lakukan tindakan atau panggil fungsi JavaScript lainnya di sini
                    }
                </script> --}}

                <br>
                <div class="text-end">
                    <button class="btn text-light" style="background-color: rgba(33, 33, 150, 0.753);" name="btnCheckOut"
                        value="checkout">Buat Pesanan</button>
                </div>
        </form>
    </div>
    <script
        src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"
    ></script>
    <script>
        function updateOrder() {
            var selectedOption = $("#order_disc option:selected");

            var voucherPotongan = parseFloat(selectedOption.data('potongan')) || 0;

            var productSubtotal = parseFloat("{{ $total }}") || 0;
            var totalDiscount = (voucherPotongan / 100) * productSubtotal;
            var grandTotal = productSubtotal - totalDiscount;

            $("#productSubtotal").html("<b>$ " + productSubtotal.toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, ",") + "</b>");
            $("#totalDiscount").html("<b>$ " + totalDiscount.toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, ",") + "</b>");
            if(selectedOption.data('namavoucher')) {
                $("#voucherValue").html("<b>" + selectedOption.data('namavoucher') + "</b>");
            } else {
                $("#voucherValue").html("<b>-</b>");
            }
            $("#grandTotal").html("<b>$ " + grandTotal.toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, ",") + "</b>");
        }

        // Call the function initially
        updateOrder();

        // Bind the function to select change event
        $("#order_disc").on("change", function () {
            updateOrder();
        });
    </script>
@endsection
