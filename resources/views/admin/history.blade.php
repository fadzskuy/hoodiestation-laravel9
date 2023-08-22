@extends('admin.sidebar')
@section('admin')
    <div class="container">
        <h1 class="text-center mt-5 p-4">Laporan Transaksi</h1>
        <a href="{{ url('historypdf') }}" target="_blank">
            <button class="btn btn-primary">
                <i class="bx bx-printer icon"></i>
                Cetak Laporan</button>
        </a>
        <table class="table table-hover table-bordered border-secondary table mt-5">
            <thead>
                <tr class="table-primary">
                    <th class="text-center" scope="col">No</th>
                    <th class="text-center" scope="col">Nama Pembeli</th>
                    <th class="text-center" scope="col">Nama Produk</th>
                    <th class="text-center" scope="col">Harga</th>
                    <th class="text-center" scope="col">Kuantitas</th>
                    <th class="text-center" scope="col">Ukuran</th>
                    <th class="text-center" scope="col">Total</th>
                    <th class="text-center" scope="col">Status</th>
                    <th class="text-center" scope="col">Waktu Transaksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transactionDetails as $transaction)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <th class="text-center" scope="row">{{ $transaction->name }}</th>
                        <td class="text-center">{{ $transaction->product_name }}</td>
                        <td class="text-center">Rp. {{ number_format($transaction->product_price) }}</td>
                        <td class="text-center">{{ $transaction->qty }}</td>
                        <td class="text-center">{{ $transaction->size_name }}</td>
                        <td class="text-center">Rp. {{ number_format($transaction->product_price * $transaction->qty) }}
                        </td>
                        <th class="text-center">{{ $transaction->status }}</th>
                        <td class="text-center">{{ \Carbon\Carbon::parse($transaction->updated_at)->format('h:i d-m-Y') }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
