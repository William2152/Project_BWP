@extends('template.main')

@section('navbar')
    <div class="container d-flex justify-content-center">
        <form class="d-flex">
            @csrf
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" style="width: 50vw">
            <button class="btn btn-outline" style="background-color: aliceblue; color: black" type="submit">Search</button>
        </form>
    </div>
    <div class="justify-content-center">
        <form action="{{ url('/loginPage') }}" method="GET">
            <input type="submit" value="Log In" class="btn me-2" style="background-color: none; color: aliceblue;">
        </form>
    </div>
@endsection
