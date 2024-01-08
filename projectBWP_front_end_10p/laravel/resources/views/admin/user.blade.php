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
            <button class="btn btn-success mt-2 mx-2 w-100" name="btnExport" value="user">Export ke Excel</button>
        </form>
        <table class="table">
            <thead>
                <th>Username</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Saldo</th>
                <th>Action</th>
            </thead>
            <tbody>
                @foreach ($user as $u)
                    @if ($u->user_role != 'Admin')
                        <tr>
                            <td>{{ $u->user_name }}</td>
                            <td>{{ $u->user_nama }}</td>
                            <td>{{ $u->user_email }}</td>
                            <td>{{ $u->user_money }}</td>
                            <td>
                                <form action="/admin/user/delete" method="post">
                                    @csrf
                                    <button value="{{ $u->user_id }}" name="delete">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
