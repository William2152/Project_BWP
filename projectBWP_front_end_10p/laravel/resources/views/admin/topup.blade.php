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
        <table class="table">
            <thead>
                <th>Username</th>
                <th>jumlah Saldo</th>
                <th>action</th>
                <th>action</th>
            </thead>
            <tbody>
                @foreach ($topup as $u)
                    <tr>
                        <td>{{ $u->OwnerSaldo->user_name }}</td>
                        <td>$ {{ $u->topup_saldo }}</td>
                        <td>
                            <form action="{{ url('/admin/topup/berhasil') }} " method="post">
                                @csrf
                                <button value="{{ $u->topup_id }}" name="berhasil">Accept</button>
                            </form>
                        </td>
                        <td>
                            <form action="{{ url('/admin/topup/gagal') }} " method="post">
                                @csrf
                                <button value="{{ $u->topup_id }}" name="gagal">Decline</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
