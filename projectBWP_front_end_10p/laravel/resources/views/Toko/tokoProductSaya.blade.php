@extends('template.punyatoko')
@section('content')
    <div class="content" style="background-color: whitesmoke; padding-bottom: 2vw;">
        <div class="container">
            <div class="isi ms-2">
                <div class="row row-cols-5">
                    @if ($product != null)
                        @foreach ($product as $p)
                            <div class="col d-flex align-items-stretch">
                                <div class="card" style="margin-top: 2vw; width: 20vw;">
                                    <img src="{{ $p->product_img == null ? '/carousel1.jpg' : $p->product_img }}"
                                        style="object-fit: cover; height: 12vw;" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $p->product_name }}</h5>
                                        <p class="card-text fw-bold">Price : Rp {{ $p->product_price }}</p>
                                        <p class="card-text fw-bold">Stok : {{ $p->product_stock }}</p>
                                        <p class="card-text">{{ $p->product_detail }}</p>
                                    </div>
                                    <div class="ms-3 mt-auto mb-3">
                                        <a href="{{ url('/edit/' . $p->product_id) }}" class="btn btn-primary">Edit Item</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection
