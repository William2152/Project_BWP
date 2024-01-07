@extends('template.main')

@section('navbar')
    <div class="container d-flex justify-content-between">
        <div>

        </div>
        <form id="searchForm" action="{{ url('/search/') }}" class="d-flex" method="POST">
            @csrf
            <input id="searchInput" class="form-control me-2" type="search" name="search" placeholder="Search"
                aria-label="Search" style="width: 50vw">
            <button class="btn btn-outline" style="background-color: aliceblue; color: black" type="submit">Search</button>
        </form>

        <script>
            document.getElementById('searchForm').addEventListener('submit', function(event) {
                // Mendapatkan nilai dari input search
                var searchValue = document.getElementById('searchInput').value;

                // Menyusun URL dengan nilai search
                var actionUrl = "{{ url('/search/') }}" + '/' + encodeURIComponent(searchValue);

                // Mengatur action form dengan URL yang sudah disusun
                this.action = actionUrl;
            });
        </script>

        <div class="row w-10">

            <div class="col-8">
                <a class="nav-link active text-light text-center fw-bold" style="" aria-current="page"
                    href="{{ url('/kurir/daftar') }}">Daftar
                    Kurir</a>
            </div>
            <div class="col-4">
                <a class="nav-link text-light text-center fw-bold" href="{{ url('/loginPage') }}">Login</a>
            </div>
        </div>
    </div>
@endsection
