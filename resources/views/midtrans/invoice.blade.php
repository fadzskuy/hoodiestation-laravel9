<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="{{ asset('storage/img/logo.png') }}" type="image">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body>
    @php
        $total = 0;
    @endphp
    <title>{{ $title }}</title>
    <div class="container">
        <h1 class="my-4 text-center">Riwayat Pembelian Saya ({{ $order->count() }})</h1>
        <a href="/shop" class="btn btn-continue rounded-pill">Lanjutkan Belanja</a>
        <p class="mt-2">Note : Pesanan tidak dapat dibatalkan jika lewat dari 24 jam!</p>
        <table class="table table-hover border-secondary my-3">
            <thead class="table-success">
                <tr>
                    <th scope="col" class="text-center">No</th>
                    <th scope="col" class="text-center">Gambar Produk</th>
                    <th scope="col" class="text-center">Nama Produk</th>
                    <th scope="col" class="text-center">Kuantitas</th>
                    <th scope="col" class="text-center">Status</th>
                    <th scope="col" class="text-center"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order as $o)
                    <tr>
                        <th class="text-center">{{ $loop->iteration }}</th>
                        <td class="text-center"><img src={{ asset('storage/' . $o->product->image) }} width="90px">
                        </td>
                        <td class="text-center">{{ $o->product->name }}</td>
                        <td class="text-center">{{ $o->qty }}</td>
                        <th class="text-center">{{ $o->status }}</th>
                        <td>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#exampleModal-{{ $o->product->id }}">
                                <i class="bi bi-eye"></i>
                            </button>
                            @if ($o->status != 'Dibatalkan')
                                @php
                                    $transactionTime = strtotime($o->created_at);
                                    $currentTime = time();
                                    $timeDifference = $currentTime - $transactionTime;
                                    $timeLimit = 24 * 60 * 60; // 24 jam dalam detik
                                @endphp
                                @if ($timeDifference < $timeLimit)
                                    <form action="{{ route('batal', ['id' => $o->id]) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        <input type="hidden" name="transaction_id" value="{{ $o->id }}">
                                        <input type="hidden" name="id" value="{{ $o->id }}">
                                        <button onclick="return confirm('Anda yakin ingin membatalkan transaksi?')"
                                            type="submit" class="btn btn-danger">Batalkan</button>
                                    </form>
                                @endif
                            @endif

                            <div class="modal fade" id="exampleModal-{{ $o->product->id }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Pesanan</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            {{-- <p>ID Pesanan : {{ $o->id }}</p> --}}
                                            <p>Nama Produk : {{ $o->product->name }}</p>
                                            <p>Harga Satuan : Rp. {{ number_format($o->product->price) }}</p>
                                            <p>Total : Rp. {{ number_format($o->product->price * $o->qty) }}</p>
                                            <p>Kuantitas : {{ $o->qty }}</p>
                                            <p>Ukuran : {{ $o->size->name }}</p>
                                            <p>Waktu Pembelian : {{ $o->updated_at->format('H:i d-m-Y') }}</p>
                                            <p>Status Pesanan : {{ $o->status }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    {{-- @php
                $total += ($o->product->price * $o->qty);
                @endphp --}}
                @endforeach
            </tbody>
        </table>
        {{-- <h5 class="mb-5">Total Belanja Keseluruhan: Rp. {{ number_format($total) }}</h5> --}}
    </div>
    @include('sweetalert::alert')
</body>

</html>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.min.js"
    integrity="sha384-heAjqF+bCxXpCWLa6Zhcp4fu20XoNIA98ecBC1YkdXhszjoejr5y9Q77hIrv8R9i" crossorigin="anonymous">
</script>
<style>
    .btn-continue {
        background-color: orangered;
        color: white;
        border: none;
        padding: 7px 14px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        cursor: pointer;
    }

    .btn-continue:hover {
        background-color: orange;
        color: white;
    }
</style>
