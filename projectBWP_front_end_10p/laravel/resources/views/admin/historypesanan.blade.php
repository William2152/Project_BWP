@extends('template.Admin')
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<style>
    .isi {
        background-color: whitesmoke;
        height: 50vw;
        overflow-y: auto;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th,
    td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
    }

    table.table tbody tr td,
    table.table thead tr th,
    table.table thead {
        border-left: 2px solid black;
        border-right: 2px solid black;
    }
</style>

@section('isimenu')
    @if ($errors->any())
        <div class="alert alert-danger mb-4">{{ $errors->first() }}</div>
        {{-- @foreach ($errors->all() as $pesanError)
            @endforeach --}}
    @elseif (Session::has('success'))
        <div class="alert alert-success">{{ Session::get('success') }}</div>
    @elseif (Session::has('err'))
        <div class="alert alert-danger">{{ Session::get('err') }}</div>
    @endif
    <div class="isi" style="margin-top: 1vw;">
        <form action="{{ url('admin/export') }}" method="post">
            @csrf
            <button class="btn btn-success mt-2 mx-2 w-100" name="btnExport" value="order">Export ke Excel</button>
        </form>
        <div class="row">
            <div class="col-1">
                <h5>Filter</h5>
            </div>
            <div class="col-2">
                <select name="filter" id="filterDropdown">
                    <option disabled selected hidden value="ANJ">Nama User</option>
                    @foreach ($user as $u)
                        @if ($u->user_role == 'storeOwner' || $u->user_role == 'Customer')
                            <option value="{{ $u->user_id }}">{{ $u->user_name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="col-2">
                <form id="filterForm" method="post" action="{{ url('/admin/filter') }}">
                    @csrf
                    <input type="hidden" name="filter" id="filterInput" value="">
                    <input type="submit" value="Filter" name="filter">
                </form>
            </div>
        </div>

        <table class="table">
            <thead>
                <th>Waktu Order</th>
                <th>Username</th>
                <th>Potongan</th>
                <th>Store</th>
                <th>Kurir</th>
                <th>Status</th>
                <th>Order_destination</th>
                <th>Total</th>
            </thead>
            <tbody>
                @foreach ($order as $o)
                    <tr>
                        <td>{{ $o->created_at }}</td>
                        <td>{{ $o->Owned->user_name }}</td>
                        @if ($o->voucher_id != null)
                            <td>{{ $o->Voucher->voucher_potongan }}</td>
                        @else
                            <td> - </td>
                        @endif
                        <td>{{ $o->Toko->store_name }}</td>
                        @if ($o->kurir_id != null)
                            <td>{{ $o->Kurir->user_name }}</td>
                        @else
                            <td> - </td>
                        @endif
                        @if ($o->order_status == 0)
                            <td>Belum dikonfirmasi Toko</td>
                        @elseif ($o->order_status == 1)
                            <td>Menunggu Acc dari Admin Kurir</td>
                        @elseif ($o->order_status == 2)
                            <td>Sedang Dikirim oleh Kurir</td>
                        @elseif ($o->order_status == 3)
                            <td>Selesai</td>
                        @endif
                        <td>{{ $o->order_destination }}</td>
                        <td>{{ $o->order_total_amount }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script>
        // Menangkap perubahan pada dropdown
        $('#filterDropdown').change(function() {
            // Memperbarui nilai input tersembunyi sesuai dengan nilai dropdown yang dipilih
            $('#filterInput').val($(this).val());
        });

        // Menangkap pengajuan formulir
        $('#filterForm').submit(function(e) {
            // Formulir akan diarahkan ke URL dinamis sesuai dengan nilai dropdown yang dipilih
            var hehe = "";
            if ($('#filterInput').val() == "") {
                hehe = "-";
            } else {
                hehe = $('#filterInput').val();
            }
            $(this).attr('action', '/admin/filter/' + hehe);
        });
    </script>
@endsection
