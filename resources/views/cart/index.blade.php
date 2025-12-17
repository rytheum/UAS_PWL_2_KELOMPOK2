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
        }

        .cart-header h2 {
            margin: 0;
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

        .price,
        .total {
            font-weight: bold;
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
            text-decoration: none;
            font-weight: bold;
        }

        .empty-cart {
            text-align: center;
            margin-top: 100px;
        }
    </style>
</head>

<body>

    <div class="container">

        <div class="cart-header">
            <h2>Shopping Cart</h2>
            <span>{{ $carts->sum('quantity') }} Items</span>
        </div>

        @if($carts->isEmpty())
            <div class="empty-cart">
                <p>Cart masih kosong</p>
                <a href="{{ route('landing') }}">Belanja sekarang</a>
            </div>
        @else

            <div class="cart-table-header">
                <div>Product Details</div>
                <div>Quantity</div>
                <div>Price</div>
                <div>Total</div>
            </div>

            @php $grandTotal = 0; @endphp

            @foreach($carts as $cart)
                        @php
                $subtotal = $cart->quantity * $cart->product->price;
                $grandTotal += $subtotal;
                        @endphp

                        <div class="cart-item">
                            {{-- Product --}}
                            <div class="product">
                                <img src="{{ asset('storage/images/' . $cart->product->image) }}">
                                <div class="product-name">
                                    {{ $cart->product->name }}
                                </div>
                            </div>

                            {{-- Quantity --}}
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

                            {{-- Price --}}
                            <div class="price">
                                Rp {{ number_format($cart->product->price, 0, ',', '.') }}
                            </div>

                            {{-- Total --}}
                            <div class="total">
                                Rp {{ number_format($subtotal, 0, ',', '.') }}
                            </div>
                        </div>
            @endforeach

            <div class="checkout-wrapper">
                <a href="{{ route('checkout.instant') }}" class="checkout-btn">
                    CheckOut >
                </a>
            </div>

        @endif
    </div>

</body>

</html>