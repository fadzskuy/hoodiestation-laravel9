<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- @TODO: replace SET_YOUR_CLIENT_KEY_HERE with your client key -->
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.client_key') }}"></script>
    <!-- Note: replace with src="https://app.midtrans.com/snap/snap.js" for Production environment -->
    <link rel="icon" href="{{ asset('storage/img/logo.png') }}" type="image">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<title>{{ $title }}</title>

<body>
    @php
        $total = 0;
    @endphp
    <div class="container">
        <h1 class="my-4 text-center">Daftar Pesanan</h1>
        <h6 class="my-2">Alamat : {{ Auth::user()->address }}</h6>
        <h6 class="my-2">Email : {{ Auth::user()->email }}</h6>
        <table class="table table-bordered my-3">
            <thead class="table-primary">
                <tr>
                    <th scope="col" class="text-center">No</th>
                    <th scope="col" class="text-center">Gambar Produk</th>
                    <th scope="col" class="text-center">Nama Produk</th>
                    <th scope="col" class="text-center">Harga Produk</th>
                    <th scope="col" class="text-center">Kuantitas</th>
                    <th scope="col" class="text-center">Ukuran</th>
                    <th scope="col" class="text-center">Status</th>
                    <th scope="col" class="text-center">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order as $o)
                    @if ($o->status == 'Belum Bayar')
                        <tr>
                            <th class="text-center">{{ $loop->iteration }}</th>
                            <td class="text-center"><img src={{ asset('storage/' . $o->product->image) }}
                                    width="90px"></td>
                            <td class="text-center">{{ $o->product->name }}</td>
                            <td class="text-center">Rp. {{ number_format($o->product->price) }}</td>
                            <td class="text-center">{{ $o->qty }}</td>
                            <td class="text-center">{{ $o->size->name }}</td>
                            <th class="text-center">{{ $o->status }}</th>
                            <td class="text-center">Rp. {{ number_format($o->product->price * $o->qty) }}</td>
                        </tr>
                        @php
                            $total += $o->product->price * $o->qty;
                        @endphp
                    @endif
                @endforeach
            </tbody>
        </table>
        <h5 class="mb-3">Subtotal : Rp. {{ number_format($total) }}</h5>
        <form action="{{ route('cancel') }}" method="POST" class="d-inline">
            @csrf
            <button onclick="return confirm('Anda yakin ingin membatalkan transaksi?')" type="submit"
                class="btn btn-danger" id="cancel">Batalkan Transaksi</button>
        </form>
        <button class="btn btn-primary" id="pay-button">Bayar Sekarang</button>
    </div>

    @foreach ($order as $o)
        <script type="text/javascript">
            var payButton = document.getElementById('pay-button');
            payButton.addEventListener('click', function() {
                window.snap.pay('{{ $snapToken }}', {
                    onSuccess: function(result) {
                        window.location.href = '/invoice/{{ $o->id }}'
                        console.log(result);
                    },
                    onPending: function(result) {
                        alert("wating your payment!");
                        console.log(result);
                    },
                    onError: function(result) {
                        alert("payment failed!");
                        console.log(result);
                    },
                    onClose: function() {
                        alert('you closed the popup without finishing the payment');
                    }
                })
            });
        </script>
    @endforeach
</body>

</html>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.min.js"
    integrity="sha384-heAjqF+bCxXpCWLa6Zhcp4fu20XoNIA98ecBC1YkdXhszjoejr5y9Q77hIrv8R9i" crossorigin="anonymous">
</script>
