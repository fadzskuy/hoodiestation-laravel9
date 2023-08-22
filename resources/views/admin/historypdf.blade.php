<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Transaksi</title>
</head>

<body>
    <style>
        h1 {
            text-align: center;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            text-align: center;
            padding: 8px;
            border: 1px solid #ddd;
        }

        th {
            background-color: #8b8b8b;
            color: #fff;
            font-weight: bold;
        }

        tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tbody tr:hover {
            background-color: #ddd;
        }
    </style>

    <div class="container">
        <h1 class="text-center mt-5 p-4">Laporan Transaksi</h1>

        <table class="table table-hover table-bordered border-secondary table mt-5">
            <thead class="thead">
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
                        <td class="text-center" scope="row">{{ $transaction->name }}</td>
                        <td class="text-center">{{ $transaction->product_name }}</td>
                        <td class="text-center">Rp. {{ number_format($transaction->product_price) }}</td>
                        <td class="text-center">{{ $transaction->qty }}</td>
                        <td class="text-center">{{ $transaction->size_name }}</td>
                        <td class="text-center">Rp. {{ number_format($transaction->product_price * $transaction->qty) }}
                        </td>
                        <td class="text-center">{{ $transaction->status }}</td>
                        <td class="text-center">
                            {{ \Carbon\Carbon::parse($transaction->updated_at)->format('h:i d-m-Y') }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
