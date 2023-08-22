@extends('layouts.template')
@section('template')
    <section class="home_banner_area mb-40">
        <div class="banner_inner d-flex align-items-center">
            <div class="container">
                <div class="banner_content">
                    <div class="col-lg-6">
                        <h3><span>HOODIE STATION</span></h3>
                        <h5>Long-sleeved hoodie in soft sweatshirt fabric with a kangaroo pocket, pocket, double-layered
                            drawstring hood with a wrapover front, and ribbing at the cuffs and hem</h5>
                        <a class="main_btn mt-40" href="{{ url('/shop') }}">Lihat Hoodie Lainnya</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="single-feature">
                    <a class="title">
                        <i class="flaticon-money"></i>
                        <h3>money back guarantee</h3>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="single-feature">
                    <a class="title">
                        <i class="flaticon-support"></i>
                        <h3>alway support</h3>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="single-feature">
                    <a class="title">
                        <i class="flaticon-truck"></i>
                        <h3>Free Delivery</h3>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="single-feature">
                    <a class="title">
                        <i class="flaticon-blockchain"></i>
                        <h3>secure payment</h3>
                    </a>
                </div>
            </div>
        </div>
    </div>
    {{-- <section class="offer_area">
    <div class="container">
        <div class="row justify-content-center">
            <div class="offset-lg-4 col-lg-6 text-center">
                <div class="offer_content">
                    <h3 class="text-uppercase mb-40">Semua Kategori Pria</h3>
                    <h2 class="text-uppercase">Diskon 40%</h2>
                    <a href="#" class="main_btn mb-20 mt-5">Discover Now</a>
                    {{-- <p>Limited Time Offer</p> --}}
    </div>
    </div>
    </div>
    </div>
    </section> --}}
    <section class="new_product_area">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="main_title">
                        <h1 class="text-black font-weight-bold">Produk Baru</h1>
                        <hr class="divider" />
                    </div>
                </div>
            </div>

            <div class="row">
                @foreach ($data as $product)
                    @php
                        $stok = $product->stok ?? 0;
                    @endphp
                    <div class="col-lg-6">
                        <div class="new_product">
                            <h5 class="text-uppercase">Hoodie Terbaru 2023</h5>
                            <h3 class="text-uppercase">{{ $product->name }}</h3>
                            <div class="product-img">
                                <img class="img-fluid" src="{{ asset('storage/' . $product->image) }}" width="400" />
                                @if ($product->stok == 0)
                                    <div class="sold-out">Sold Out</div>
                                @endif
                            </div>
                            <h4>Rp. {{ number_format($product->price) }}</h4>
                            <form action="/cart/store" method="post">
                                @csrf
                                <input type="hidden" value="{{ $product->id }}" name="product_id">
                                <button type="submit" class="btn btn-1" {{ $stok == 0 ? 'disabled' : '' }}><i
                                        class="bi bi-bag-plus-fill"></i> Tambah Ke Keranjang</button>
                            </form>
                        </div>
                    </div>
                @endforeach

                <div class="col-lg-6 mt-5 mt-lg-0">
                    <div class="row">
                        @foreach ($products as $product)
                            @php
                                $stok = $product->stok ?? 0;
                            @endphp
                            <div class="col-lg-6 col-md-6">
                                <div class="single-product">
                                    <div class="product-img">
                                        <a href="/shop/show/{{ $product->id }}">
                                            <img class="img-fluid w-100" src="{{ asset('storage/' . $product->image) }}"
                                                alt="" />
                                            @if ($product->stok == 0)
                                                <div class="sold-out">Sold Out</div>
                                            @endif
                                        </a>
                                        <div class="p_icon">
                                            <a href="/shop/show/{{ $product->id }}">
                                                <i class="ti-eye"></i>
                                            </a>
                                            <form action="/cart/store" method="post" class="d-inline">
                                                @csrf
                                                <input type="hidden" value="{{ $product->id }}" name="product_id">
                                                <button type="submit" class="btn btn1"
                                                    {{ $stok == 0 ? 'disabled' : '' }}><i
                                                        class="bi bi-bag-plus-fill"></i></button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="product-btm">
                                        <a href="/shop/show/{{ $product->id }}" class="d-block">
                                            <h4>{{ $product->name }}</h4>
                                        </a>
                                        <div class="mt-3">
                                            <span class="mr-4">Rp. {{ number_format($product->price) }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('sweetalert::alert')
@endsection
