@extends('template.Admin')
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
    <div class="isi" style="margin-top: 1vw;">
        <table class="table">
            <thead>
                <th>Username</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Saldo</th>
            </thead>
            <tbody>
                @foreach ($user as $u)
                    <tr>
                        <td>{{ $u->user_name }}</td>
                        <td>{{ $u->user_nama }}</td>
                        <td>{{ $u->user_email }}</td>
                        <td>{{ $u->user_money }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
