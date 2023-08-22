@extends('admin.sidebar')
@section('admin')
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6">
                <form action="/update/{{ $product->id }}" method="POST" enctype="multipart/form-data" class="pt-5 mt-5" enctype="multipart/form-data" id="update-form">
                @method('put')
                @csrf
                <h2 class="my-3 text-center">EDIT DATA PRODUK</h2>
                    <div class="mb-4">
                        <label for="name" class="form-label">Nama Hoodie</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Masukan nama produk..." required autofocus value="{{old('name', $product->name)}}">
                            @error('name')
                                <div class="invalid-feedback mb-3">
                                {{ $message }}
                            @enderror
                    </div>
                    <div class="mb-4">
                        <label for="price" class="form-label">Harga</label>
                        <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price" placeholder="Masukan harga produk..." value="{{old('price', $product->price)}}">
                            @error('price')
                                <div class="invalid-feedback mb-3">
                                {{ $message }}
                            @enderror
                    </div>
                    <div class="mb-4">
                        <label for="stok" class="form-label">Stok</label>
                        <input type="text" class="form-control @error('stok') is-invalid @enderror" id="stok" name="stok" placeholder="Masukan stok produk..." value="{{old('stok', $product->stok)}}">
                            @error('stok')
                                <div class="invalid-feedback mb-3">
                                {{ $message }}
                            @enderror
                    </div>
                    <div class="mb-4">
                        <label for="desc" class="form-label">Deskripsi produk</label>
                        <textarea class="form-control @error('desc') is-invalid @enderror" id="desc" name="desc" rows="3" placeholder="Masukan deskripsi produk...">{{old('desc', $product->desc)}}</textarea>
                        @error('desc')
                            <div class="invalid-feedback mb-3">
                            {{ $message }}
                        @enderror
                    </div>
                    <label for="desc" class="form-label">Kategori</label>
                    <select class="form-select mb-4" name="category_id">
                        @foreach ($categories as $category)
                            @if(old('category_id', $product->category_id) == $category->id)
                                <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                            @else
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endif
                        @endforeach
                    </select>
                    <div class="mb-4 ">
                        <label for="image" class="form-label">Gambar Produk</label>
                        <input type="hidden" name="oldImage" value="{{ $product->image }}">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" id="img-preview" class="img-preview img-fluid mb-3 col-sm-5 d-block">
                        @else
                            <img id="img-preview" class="img-preview img-fluid mb-3 col-sm-5">
                        @endif
                            <input class="form-control @error('image') is-invalid @enderror" type="file" name="image" id="image" onchange="previewImage()">
                            @error('image')
                                <div class="invalid-feedback mb-3">
                                {{ $message }}
                            @enderror
                        </div>
                    <button id="submit-button" class="btn btn-success mb-5" type="submit" class="btn btn-primary">Simpan</button>
                </form>
                    {{-- <a href="/produk"><button class="btn btn-danger" class="btn btn-primary">Cancel</button></a> --}}
            </div>
        </div>
    </div>
</body>
    <script>
    document.getElementById('update-form').addEventListener('submit', function(e) {
            e.preventDefault();
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            });

            swalWithBootstrapButtons.fire({
                title: 'Apakah kamu yakin?',
                text: "Kamu akan menyimpan perubahan ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Simpan!',
                cancelButtonText: 'Tidak, Batalkan!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // submit form update
                    this.submit();
                } else if (
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Dibatalkan',
                        'Perubahan tidak akan disimpan :)',
                        'error'
                    )
                }
            })
        });
    </script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection