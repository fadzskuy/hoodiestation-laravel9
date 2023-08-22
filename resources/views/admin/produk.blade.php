@extends('admin.sidebar')
@section('admin')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-5">
            <form action="{{ route('cari') }}" method="get">
                <div class="input-group my-4">
                    <div class="dropdown">
                        <button class="button dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Kategori
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item {{ Request::is('produk') ? 'active' : '' }}" href="/produk">All</a></li>
                            @if (isset($pesan))
                            @else
                            @foreach ($categories as $category)
                            <li><a class="dropdown-item {{ Request::is('produk/category/' . $category->id ) ? 'active' : ''}}" href="/produk/category/{{ $category->id }}">{{ $category->name }}</a></li>
                            @endforeach
                            @endif
                        </ul>
                    </div>
                    <input type="text" class="form-control" placeholder="Cari nama hoodie..." name="search" value="{{ request('search') }}">
                    <button class="btn btn-outline" type="submit"><i class="bx bx-search"></i></button>
                </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="input-group mb-3">
                <input type="number" class="form-control" placeholder="Harga min..." name="min_price" value="{{ request('min_price') }}">
                <input type="number" class="form-control" placeholder="Harga max..." name="max_price" value="{{ request('max_price') }}">
                <button class="btn btn-outline" type="submit"><i class="bx bx-search"></i></button>
                </form>
            </div>
        </div>
    </div>
    @if (isset($pesan))
    <p>{{ $pesan }}</p>
    @else
    <table class="table table-bordered">
        <thead class="table-secondary">
            <tr>
                <th scope="col">No</th>
                <th scope="col">Gambar</th>
                <th scope="col">Nama Produk</th>
                <th scope="col">Harga</th>
                <th scope="col">Stok</th>
                <th scope="col">Deskripsi</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            @foreach ($products as $product)
            <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td><img src={{ asset('storage/' . $product->image) }} width="100px"></td>
                <td>{{ $product->name }}</td>
                <td>Rp. {{number_format ($product->price) }}</td>
                <td>{{ $product->stok }}</td>
                <td>{{ $product->desc }}</td>
                <td>
                    <form action="/produk/{{ $product->id }}" method="post" class="d-inline">
                        <a href="/edit/{{ $product->id }}" class="btn btn-primary"><i class='bx bx-edit-alt'></i></a>
                        @csrf
                        @method('delete')
                        <button onclick="event.preventDefault(); if(confirm('yakin ingin hapus produk ini?')){document.getElementById('delete-form-{{$product->id}}').submit();}" type="submit" class="btn btn-danger"><i class='bx bx-trash'></i></button>
                    </form>
                    <form id="delete-form-{{$product->id}}" action="/produk/{{$product->id}}" method="POST" style="display: none;">
                        @csrf
                        @method('delete')
                    </form>
                </td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
</div>
@include('sweetalert::alert')
<style>
    .button {
        background-color: orangered;
        /* untuk warna merah */
        color: #fff;
        border-radius: 6px;
        border: none;
        padding: 7px 14px;
    }

    .dropdown-item:active {
        background-color: orangered;
        /* Warna latar belakang saat ditekan */
        color: #fff;
        /* Warna teks saat ditekan */
    }

    .form-control {
        border-color: #FFE15D;
    }

    .btn-outline {
        border-color: orangered;
        color: orangered;
        background: #fff;
    }

    .btn-outline:hover {
        background-color: orangered;
        color: #fff;
    }
</style>
@endsection
