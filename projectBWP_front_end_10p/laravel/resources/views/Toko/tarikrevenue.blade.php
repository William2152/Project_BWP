@extends('template.punyatoko')

@section('content')
    <div class="container">
        <div class="col-10" style="background-color: whitesmoke; height: auto; width: 100%; margin-bottom: 2vw;">
            @if ($errors->any())
                <div class="alert alert-danger mb-4">{{ $errors->first() }}</div>
                {{-- @foreach ($errors->all() as $pesanError)
                    @endforeach --}}
            @elseif (Session::has('success'))
                <div class="alert alert-success">{{ Session::get('success') }}</div>
            @elseif (Session::has('err'))
                <div class="alert alert-danger">{{ Session::get('err') }}</div>
            @endif
            <div class="container" style="display: flex; flex-direction: column; justify-content: center;">
                <h2 style="margin-top: 0.8vw; margin-left: 0.3vw; margin-bottom: 1vw;">Tarik Revenue</h2>
                <h5 style="margin-left: 1vw;">Revenue : $ {{ $toko->store_revenue }}</h5>
                <form action="{{ url('tokosaya/tarik/revenue') }}" method="post">
                    @csrf
                    <input style="margin-left: 1vw;" type="number" name="revenue" id="" placeholder="Amount">
                    <button class="btn btn-primary" name="btntarik">Tarik</button>
                    <br>
                </form>
            </div>
        </div>
    </div>
@endsection
