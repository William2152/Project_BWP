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
                <th>Nominal</th>
                <th>Status</th>
            </thead>
            <tbody>
                @foreach ($topups as $t)
                    <tr
                        class="{{ $t->topup_status == 0 ? 'table-info' : ($t->topup_status == 1 ? 'table-success' : 'table-danger') }}">
                        <td>Top Up</td>
                        <td>{{ $t->topup_saldo }}</td>
                        <td>
                            @if ($t->topup_status == 0)
                                sedang di proses...
                            @elseif ($t->topup_status == 1)
                                berhasil
                            @elseif ($t->topup_status == 2)
                                ditolak
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
