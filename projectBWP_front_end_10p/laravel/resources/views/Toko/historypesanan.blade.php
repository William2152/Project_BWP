@extends('template.punyaToko')

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

@section('content')
    <div class="container" style="margin-bottom: 2vw; padding-bottom: 2vw;">
        <table class="table">
            <thead>
                <th>Owner</th>
                <th>Alamat Tujuan</th>
                <th>Tanggal Transaksi</th>
                <th>Total Harga</th>
            </thead>
            <tbody>
                @foreach ($order as $o)
                    <tr>
                        <td>{{ $o->Owned->user_nama }}</td>
                        <td>{{ $o->order_destination }}</td>
                        <td>{{ $o->created_at }}</td>
                        <td>{{ $o->order_total_amount }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
