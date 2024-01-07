@extends('template.main')

@section('navbar')
    <div class="container d-flex justify-content-center">
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

    </div>
    <div class="justify-content-center">
        <form action="{{ url('/loginPage') }}" method="GET">
            <a href="{{ url('/kurir/daftar') }}"
                style="background-color: none; color: aliceblue; text-decoration: none;">Daftar Kurir</a>
            <input type="submit" value="Log In" class="btn me-2" style="background-color: none; color: aliceblue;">
        </form>
    </div>
@endsection
