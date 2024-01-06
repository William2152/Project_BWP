@extends('template.profilePage')
<style>
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    th,
    td {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }

    th {
        background-color: #f2f2f2;
    }

    tr:hover {
        background-color: #f5f5f5;
    }
</style>
@section('konten')
    <div class="col-10" style="background-color: whitesmoke; margin-bottom: 2vw;">
        <table border="1" class="table table-light">
            <thead>
                <th>Jenis Transaksi</th>
                <th>Tanggal Transaksi</th>
                <th>Nominal</th>
                <th>Status</th>
            </thead>
            <tbody>
                @foreach ($orders as $o)
                    <tr
                        class="{{ $o->order_status == 0 ? 'table-info' : ($o->order_status == 1 ? 'table-success' : 'table-danger') }}">
                        <td>Pembelian</td>
                        <td>{{ $o->created_at }}</td>
                        <td>Rp. {{ number_format($o->order_total_amount, 0, '.', ',') }}</td>
                        <td>
                            @if ($o->order_status == 0)
                                pesanan sedang di proses...
                            @elseif ($o->order_status == 1)
                                pesanan sudah di antar
                            @elseif ($o->order_status == 2)
                                pesanan sudah selesai
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
