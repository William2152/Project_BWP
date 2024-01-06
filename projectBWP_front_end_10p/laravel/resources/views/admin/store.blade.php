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
                <th>Name</th>
                <th>Email</th>
                <th>Address</th>
                <th>Owner Name</th>
                <th>Action</th>
                {{-- <th>Action</th> --}}
            </thead>
            <tbody>
                @foreach ($store as $u)
                    <tr>
                        <td>{{ $u->store_name }}</td>
                        <td>{{ $u->store_email }}</td>
                        <td>{{ $u->store_address }}</td>
                        <td>{{ $u->Owner->user_name }}</td>
                        <td>
                            <form action="{{ url('/admin/store/terima') }}" method="post">
                                @csrf
                                <button value="{{ $u->store_id }}" name="terima">Terima</button>
                            </form>
                        </td>
                        {{-- <td>
                            <form action="{{ url('/admin/store/tolak') }}" method="post">
                                @csrf
                                <button value="{{ $u->store_id }}" name="tolak">Tolak</button>
                            </form>
                        </td> --}}
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
