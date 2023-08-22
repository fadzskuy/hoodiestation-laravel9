<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="user/css/cart.css" />
    <link rel="icon" href="{{ asset('storage/img/logo.png') }}" type="image">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
</head>

<body>
    <div class="wrap cf">
        <div class="heading cf">
            @if (Session::has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-info-circle-fill p-2"></i>{{ Session::get('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @php
                $total = 0;
            @endphp

            <h1>Keranjang {{ Auth::user()->name }} ({{ $carts->count() }})</h1>
            <a href="/shop" class="continue">Lanjutkan Belanja</a>
        </div>
        @foreach ($carts as $cart)
            <div class="cart">
                <ul class="cartWrap">
                    <li class="items odd">
                        @php
                            $stok = $cart->product->stok ?? 0;
                        @endphp
                        <div class="infoWrap">
                            <div class="cartSection">
                                <img src="{{ asset('storage/' . $cart->product->image) }}" alt=""
                                    class="itemImg" />
                                <h3>{{ $cart->product->name }}</h3>
                                @if ($stok == 0)
                                    <h4 class="d-block mt-1">Sold Out</h4>
                                @else
                                    <h4 class="d-block mt-1">Stok : {{ $cart->product->stok }}</h4>
                                @endif
                                <h4 class="d-block mt-1">Size : {{ $cart->size->name }}</h4>
                                <p class="d-block mt-2">{{ $cart->product->desc }}</p>
                            </div>
                            {{-- <div class="prodTotal cartSection" style="font-size:15px;">
                            <h3><select class="size" id="size" name="size">
                                    <option value="M" selected>M</option>
                                    <option value="L">L</option>
                                    <option value="XL">XL</option>
                                </select>
                            </h3>
                        </div> --}}
                            <div class="prodTotal cartSection" style="font-size:15px;">
                                <h3>Rp. {{ number_format($cart->product->price) }},-</h3>
                            </div>


                            {{-- <select name="qty" class="quantity mt-5" data-item="{{ $cart->id }}">
                        @for ($i = 1; $i <= 10; $i++) <option value="{{$i}}" {{$cart->qty == $i ? 'selected': ''}}>{{$i}}</option>
                            @endfor
                            </select> --}}
                            <style>
                                .mt4 {
                                    margin-top: 40px;
                                }
                            </style>
                            <div class="d-flex mt4">
                                <form action="/cart/min/{{ $cart->id }}" method="post" class="d-inline">
                                    @csrf
                                    @method('put')
                                    <input type="hidden" name="product_id" value="{{ $cart->product_id }}">
                                    <input type="hidden" name="qty" value="{{ $cart->qty - 1 }}">
                                    <button type="submit" class="btn button1"><i
                                            class="bi bi-dash-circle"></i></button>
                                </form>
                                <div class="item">
                                    <div class="quantity mt-2 mx-2">
                                        <h3>{{ $cart->qty }}</h3>
                                    </div>
                                </div>
                                <form method="post" action="/cart/plus/{{ $cart->id }}" class="d-inline">
                                    @csrf
                                    @method('put')
                                    <input type="hidden" name="product_id" value="{{ $cart->product_id }}">
                                    <input type="hidden" name="qty" value="{{ $cart->qty + 1 }}">
                                    <button type="submit" class="btn button1"><i
                                            class="bi bi-plus-circle"></i></button>
                                </form>

                            </div>
                            <div class="prodTotal cartSection">
                                <h3>Rp. {{ number_format($cart->product->price * $cart->qty) }},-</h3>
                            </div>

                            <div class="cartSection deleteWrap">
                                <a href="/delete/{{ $cart->id }}" class="delete"><i class="bi bi-trash"></i></a>
                            </div>
                        </div>
                        <hr>
                    </li>
                </ul>


                {{-- <li class="items even">Item 2</li> --}}
                @php
                    $total += $cart->product->price * $cart->qty;
                @endphp
        @endforeach
    </div>

    <div class="subtotal cf">
        <ul>
            {{-- <li class="totalRow"><span class="label">Subtotal</span><span class="value">$35.00</span></li> --}}
            {{-- <li class="totalRow"><span class="label">Shipping</span><span class="value">$5.00</span></li> --}}
            <li class="totalRow final"><span class="label">Total : </span><span class="value">Rp.</span><span
                    class="value">{{ number_format($total) }}</span></li>
            <form action="{{ route('checkout') }}" method="post">
                @csrf
                <li class="totalRow">
                    <button type="submit" class="button button2 rounded-pill">Checkout</button>
                </li>
            </form>
        </ul>
    </div>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript" src="{{ asset('js/script.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"
        integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous">
    </script>
</body>

</html>
