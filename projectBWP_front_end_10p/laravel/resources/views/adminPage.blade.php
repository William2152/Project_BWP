@extends('template.templateSudahLogin')

@section('logout')
    <a href="{{ url('/logout') }}" class="btn text-light">Logout</a>
@endsection
@section('content')
    <h1>Welcome, {{ $curr->user_nama }}</h1>
@endsection
