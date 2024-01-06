@extends('template.Userliattoko')

@section('content')
    <div class="container" style="margin-bottom: 2vw;">
        <div class="content ms-2">
            <h4>Address : {{ $toko->store_address }}</h4>
        </div>
    </div>
@endsection
