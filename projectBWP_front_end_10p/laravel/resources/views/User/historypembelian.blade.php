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
        <table border="1">
            <thead>
                <th>Jenis Transaksi</th>
                <th>Nominal</th>
                <th>Status</th>
            </thead>
            <tbody>
                @for ($i = 0; $i < 5; $i++)
                    <tr>
                        <td>a</td>
                        <td>a</td>
                        <td>a</td>
                    </tr>
                @endfor
            </tbody>
        </table>
    </div>
@endsection
