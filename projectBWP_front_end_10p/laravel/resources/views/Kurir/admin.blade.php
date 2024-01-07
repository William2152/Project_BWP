@extends('template.kurir')

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
        <table class="table text-center">
            <thead>
                <th>Owner</th>
                <th>Alamat Tujuan</th>
                <th>Nama Kurir</th>
                <th>Action</th>
            </thead>
            <tbody>
                @foreach ($order as $o)
                    @if ($o->kurir_id == null)
                        <form action="{{ url('/adminKurir/assign') }}" method="post">
                            @csrf
                            <tr>
                                <td>{{ $o->Owned->user_nama }}</td>
                                <td>{{ $o->order_destination }}</td>
                                <td>
                                    <select style="width: 100%;" name="kurir" id="">
                                        <option disabled hidden selected value="NULL">Kurir</option>
                                        @foreach ($kurir as $k)
                                            <option value="{{ $k->user_id }}">{{ $k->user_nama }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td class="text-center">
                                    <button value="{{ $o->order_id }}" name="btnAssign">Assign</button>
                                </td>
                            </tr>
                        </form>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
