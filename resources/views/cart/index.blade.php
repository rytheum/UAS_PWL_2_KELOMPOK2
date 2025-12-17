<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Shopping Cart</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #fff;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 50px auto;
        }

        .cart-header {
            display: flex;
            justify-content: space-between;
            border-bottom: 2px solid #ddd;
            padding-bottom: 10px;
            margin-bottom: 30px;
            align-items: center;
        }

        .cart-table-header,
        .cart-item {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            align-items: center;
            gap: 20px;
        }

        .cart-table-header {
            font-weight: bold;
            color: #666;
            margin-bottom: 15px;
        }

        .cart-item {
            padding: 25px 0;
            border-bottom: 1px solid #ddd;
        }

        .product {
            display: flex;
            gap: 15px;
            align-items: center;
        }

        .product img {
            width: 80px;
        }

        .product-name {
            font-weight: bold;
        }

        .qty-box {
            display: flex;
            align-items: center;
            border: 1px solid #aaa;
            border-radius: 25px;
            width: fit-content;
            padding: 5px 10px;
            gap: 10px;
        }

        .qty-box button {
            background: none;
            border: none;
            font-size: 18px;
            cursor: pointer;
            padding: 0 5px;
        }

        .price {
            font-weight: bold;
        }

        .total {
            font-weight: bold;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
        }

        .action-right {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .checkout-wrapper {
            display: flex;
            justify-content: flex-end;
            margin-top: 30px;
        }

        .checkout-btn {
            background: #4CAF50;
            color: #fff;
            padding: 12px 25px;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            font-weight: bold;
        }

        .trash-btn {
            background: none;
            border: none;
            color: #e74c3c;
            font-size: 18px;
            cursor: pointer;
        }

        .empty-cart {
            text-align: center;
            margin-top: 100px;
        }
    </style>
</head>

<body>

    <div class="container">

        {{-- HEADER --}}
        <div class="cart-header">
            <div style="display:flex; align-items:center; gap:15px;">
                <a href="{{ route('landing') }}" style="text-decoration:none; font-weight:bold; color:#e74c3c;">
                    ← Back
                </a>
                <h2>Shopping Cart</h2>
            </div>

            <span>{{ $carts->sum('quantity') }} Items</span>
        </div>

        @if($carts->isEmpty())
            <div class="empty-cart">
                <p>Cart masih kosong</p>
                <a href="{{ route('landing') }}">Belanja sekarang</a>
            </div>
        @else

            {{-- FORM CHECKOUT --}}
            <form action="" method="GET">

                <div class="cart-table-header">
                    <div>Product Details</div>
                    <div>Quantity</div>
                    <div>Price</div>
                    <div>Total</div>
                </div>

                @foreach($carts as $cart)
                    @php
                        $subtotal = $cart->quantity * $cart->product->price;
                    @endphp

                    <div class="cart-item">

                        {{-- PRODUCT --}}
                        <div class="product">
                            <img src="{{ asset('storage/images/' . $cart->product->image) }}">
                            <div class="product-name">
                                {{ $cart->product->name }}
                            </div>
                        </div>

                        {{-- QUANTITY --}}
                        <div>
                            <div class="qty-box">
                                <form method="POST" action="{{ route('cart.update', $cart->id_cart) }}">
                                    @csrf
                                    <input type="hidden" name="action" value="decrease">
                                    <button type="submit">−</button>
                                </form>

                                <span>{{ $cart->quantity }}</span>

                                <form method="POST" action="{{ route('cart.update', $cart->id_cart) }}">
                                    @csrf
                                    <input type="hidden" name="action" value="increase">
                                    <button type="submit">+</button>
                                </form>
                            </div>
                        </div>

                        {{-- PRICE --}}
                        <div class="price">
                            Rp {{ number_format($cart->product->price, 0, ',', '.') }}
                        </div>

                        {{-- TOTAL + CHECKBOX + DELETE (KANAN) --}}
                        <div class="total">
                            Rp {{ number_format($subtotal, 0, ',', '.') }}

                            <div class="action-right">
                                <input type="checkbox" name="cart_ids[]" value="{{ $cart->id_cart }}" checked>

                                <form action="{{ route('cart.delete', $cart->id_cart) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="trash-btn">🗑</button>
                                </form>
                            </div>
                        </div>

                    </div>
                @endforeach

                {{-- CHECKOUT --}}
                <div class="checkout-wrapper">
                    <button type="submit" class="checkout-btn">
                        Checkout >
                    </button>
                </div>

            </form>
        @endif

    </div>

</body>

</html>