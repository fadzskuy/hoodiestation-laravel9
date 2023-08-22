@extends('layouts.template')
@section('template')


{{-- <h1 class="text-center font-weight-bold">Our Product</h1>
<hr class="divider"/> --}}
<div class="mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="{{ route('search') }}" method="get">
                <div class="input-group mb-3">
                    <div class="dropdown">
                        <button class="button dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Kategori
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item {{ Request::is('shop') ? 'active' : '' }}" href="/shop">All</a></li>
                            @if (isset($message))
                            @else
                            @foreach ($categories as $category)
                            <li><a class="dropdown-item {{ Request::is('shop/category/' . $category->id ) ? 'active' : ''}}" href="/shop/category/{{ $category->id }}">{{ $category->name }}</a></li>
                            @endforeach
                            @endif
                        </ul>
                    </div>
                    <input type="text" class="form-control" placeholder="Cari nama hoodie..." name="search" value="{{ request('search') }}">
                    <button class="btn btn-outline" type="submit"><i class="bi bi-search"></i></button>
                </div>
        </div>
    </div>
</div>
<div class="row justify-content-center">
    <div class="col-md-4">
        <div class="input-group mb-3">
            <input type="number" class="form-control" placeholder="Harga min..." name="min_price" value="{{ request('min_price') }}">
            <input type="number" class="form-control" placeholder="Harga max..." name="max_price" value="{{ request('max_price') }}">
            <button class="btn btn-outline" type="submit"><i class="bi bi-search"></i></button>
            </form>
        </div>
    </div>
</div>

<div class="latest_product_inner">
    <div class="container">
        <div class="mt-5">
            <div class="row">
                @if (isset($message))
                <p>{{ $message }}</p>
                @else
                @foreach ($products as $product)
                @php
                $stok = $product->stok ?? 0;
                @endphp
                <div class="col-lg-3 col-md-6">
                    <div class="single-product">
                        <div class="product-img">
                            <a href="/shop/detail/{{$product->id}}">
                                <img class="card-img" src="{{ asset('storage/' . $product->image) }}" alt="" />
                                @if($product->stok == 0)
                                <div class="sold-out">Sold Out</div>
                                @endif
                            </a>
                            <div class="p_icon">
                                <a href="/shop/detail/{{$product->id}}">
                                    <i class="ti-eye"></i>
                                </a>
                                <form action="/cart/store" method="post" class="d-inline">
                                    @csrf
                                    <input type="hidden" value="{{ $product->id }}" name="product_id">

                                    <button type="submit" class="btn btn1" {{ $stok == 0 ? 'disabled' : '' }}><i class="bi bi-bag-plus-fill"></i></button>
                                </form>
                            </div>
                        </div>
                        <div class="product-btm">
                            <a href="/shop/detail/{{$product->id}}" class="d-block">
                                <h4>{{ $product->name }}</h4>
                            </a>
                            <div class="mt-3">
                                <span class="mr-2">Rp. {{ number_format($product->price) }}</span>
                                {{-- <del>Rp 300.000</del> --}}
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            {!! $products->links() !!}
            @endif
            <br><br><br>
        </div>
    </div>
</div>
@include('sweetalert::alert')
@endsection
