@extends('template.categoryTemplate')

@section('header')
    <h4 style="color: white;">Clothes</h4>
@endsection

@section('product')
    <div class="container">
        <div class="content ms-2">
            <div class="row row-cols-5">
                @foreach ($product as $p)
                    <div class="col d-flex align-items-stretch">
                        <div class="card" style="margin-top: 2vw; width: 20vw;">
                            <img src="{{ $p->product_img }}" style=" height: 12vw; object-fit: cover;"
                                class="card-img-top img-fluid w-100" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">{{ $p->product_name }}</h5>
                                <p class="card-text">{{ $p->Category->category_name }}</p>

                            </div>
                            <div class="ms-3 mt-auto mb-3">
                                <a href="{{ url('itemPage/' . $p->product_id) }}" class="btn btn-primary">Detail Item</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
@endsection
