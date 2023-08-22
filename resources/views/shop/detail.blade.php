@extends('layouts.template')
@section('template')
    <div class="container">
        <a class="btn btn2" href="/shop">
            <i class="bi bi-arrow-left" style="color: white;"></i>
        </a>
    </div>
    @php
        $stok = $data->stok ?? 0;
    @endphp
    <div class="product_image_area">
        <div class="container">
            <div class="row s_product_inner">
                <div class="col-lg-6">
                    <div class="s_product_img">
                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img class="d-block w-100" src="{{ asset('storage/' . $data->image) }}"
                                        alt="First slide" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 offset-lg-1">
                    <div class="s_product_text">
                        <h3>{{ $data->name }}</h3>
                        <h2>Rp. {{ number_format($data->price) }}</h2>
                        <ul class="list">
                            <li>
                                <a class="active">
                                    <span>Category</span> : {{ $data->category->name }}</a>
                            </li>
                            <li>
                                <a class="active">
                                    <span>Stok</span>: {{ $data->stok }} </a>
                            </li>
                        </ul>
                        <form action="/cart/store" method="post">
                            @csrf
                            <div class="d-flex mb-3">
                                <label for="size"><span>Size : </span></label>
                                @foreach ($sizes as $size)
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="size"
                                            id="{{ $size->id }}" value="{{ $size->id }}"
                                            {{ $loop->first ? 'checked' : '' }}>
                                        <label class="form-check-label" type="radio" name="size"
                                            for="{{ $size->id }}">
                                            {{ $size->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                            <p>
                                {{ $data->desc }}
                            </p>
                            <input type="hidden" value="{{ $data->id }}" name="product_id">
                            <button type="submit" class="btn btn-1" {{ $stok == 0 ? 'disabled' : '' }}><i
                                    class="bi bi-bag-plus-fill"></i> Tambah ke Keranjang</button>
                            {{-- <a class="main_btn" href="/shop" role="button">Buy Now</a> --}}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        const sizeRadios = document.querySelectorAll('input[name="size"]');

        sizeRadios.forEach(radio => {
            radio.addEventListener('click', () => {
                sizeRadios.forEach(otherRadio => {
                    if (otherRadio !== radio) {
                        otherRadio.remove = true;
                        otherRadio.parentNode.classList.add(
                            'text-muted'
                        ); // tambahkan class 'text-muted' untuk tombol radio yang dinonaktifkan
                    } else {
                        otherRadio.disabled = false;
                        otherRadio.parentNode.classList.remove(
                            'text-muted'
                        ); // hilangkan class 'text-muted' untuk tombol radio yang dipilih
                    }
                });
            });
        });
    </script>
    @include('sweetalert::alert')
@endsection
