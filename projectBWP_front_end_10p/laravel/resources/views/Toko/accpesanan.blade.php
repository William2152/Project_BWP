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
    @if ($errors->any())
        <div class="alert alert-danger mb-4">{{ $errors->first() }}</div>
        {{-- @foreach ($errors->all() as $pesanError)
            @endforeach --}}
    @elseif (Session::has('success'))
        <div class="alert alert-success">{{ Session::get('success') }}</div>
    @elseif (Session::has('err'))
        <div class="alert alert-danger">{{ Session::get('err') }}</div>
    @endif
    <div class="container" style="margin-bottom: 2vw; padding-bottom: 2vw;">
        <table class="table">
            <thead>
                <th>Owner</th>
                <th>Alamat Tujuan</th>
                <th>Tanggal Transaksi</th>
                <th>Total Harga</th>
                <th>Action</th>
                <th>Detail</th>
            </thead>
            <tbody>
                @foreach ($order as $o)
                    @if ($o->order_status == 0)
                        <tr>
                            <td>{{ $o->Owned->user_nama }}</td>
                            <td>{{ $o->order_destination }}</td>
                            <td>{{ $o->created_at }}</td>
                            <td>{{ $o->order_total_amount }}</td>
                            <td>
                                <form action="{{ url('/tokosaya/acc') }}" method="post">
                                    @csrf
                                    <button class="btn btn-success" value="{{ $o->order_id }}"
                                        name="btnTerima">Terima</button>
                                </form>
                            </td>
                            <td>
                                <a href="{{ url('/tokosaya/pesanan/detail/' . $o->order_id) }}"
                                    class="btn btn-primary text-light" name="btnDetail">Detail</a>
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
