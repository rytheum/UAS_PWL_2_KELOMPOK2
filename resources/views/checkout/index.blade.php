<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Checkout</title>

    <style>
        body { font-family: Arial; background: #fff; }
        .container { width: 900px; margin: 50px auto; }
        .item {
            display: flex;
            gap: 20px;
            border-bottom: 1px solid #ccc;
            padding: 20px 0;
            align-items: center;
        }
        img { width: 120px; }
        .summary { margin-top: 30px; font-size: 18px; }
        textarea, select {
            width: 100%;
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #ccc;
            margin-top: 6px;
        }
        button {
            padding: 12px 25px;
            background: #6bd26b;
            border: none;
            color: #fff;
            border-radius: 10px;
            cursor: pointer;
        }
        .section {
            margin-top: 20px;
        }

        .action {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 30px;
        }

        .btn-back {
            background: #e74c3c; /* MERAH */
            color: #fff;
            text-decoration: none;
            padding: 12px 22px;
            border-radius: 10px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .btn-back:hover {
            background: #c0392b;
        }

        .btn-confirm {
            background: #6bd26b;
            padding: 12px 35px;   /* ❗ PANJANG NORMAL */
            border-radius: 10px;
            border: none;
            color: #fff;
            cursor: pointer;
        }


    </style>
</head>

<body>

<div class="container">
    @if ($errors->any())
        <div style="background: #ffebee; color: #c62828; padding: 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #ef9a9a;">
            <strong style="display: block; margin-bottom: 10px;">⚠️ Terjadi Kesalahan:</strong>
            <ul style="margin: 0; padding-left: 20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div style="background: #e8f5e9; color: #2e7d32; padding: 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #a5d6a7;">
            ✅ {{ session('success') }}
        </div>
    @endif

    <h2>Checkout Detail</h2>

{{-- ================= CART CHECKOUT ================= --}}
@if(isset($items))
    @foreach($items as $item)
        <div class="item">
            <img src="{{ asset('storage/images/' . $item->product->image) }}">

            <div style="flex:1">
                <h3>{{ $item->product->title }}</h3>
                <p>Quantity : <strong>{{ $item->quantity }}</strong></p>
            </div>

            <div>
                <p>Price</p>
                <strong>
                    Rp{{ number_format($item->subtotal,0,',','.') }}
                </strong>
            </div>
        </div>
    @endforeach

    <div class="summary">
        <p>Total Items : <strong>{{ $totalQty }}</strong></p>
        <p>Total Price :
            <strong>Rp{{ number_format($totalPrice,0,',','.') }}</strong>
        </p>
    </div>

{{-- ================= INSTANT CHECKOUT ================= --}}
@elseif(isset($product))
    <div class="item">
        <img src="{{ asset('storage/images/' . $product->image) }}">

        <div style="flex:1">
            <h3>{{ $product->title }}</h3>
            <p>Quantity : <strong>{{ $qty }}</strong></p>
        </div>

        <div>
            <p>Price</p>
            <strong>
                Rp{{ number_format($subtotal,0,',','.') }}
            </strong>
        </div>
    </div>

    <div class="summary">
        <p>Total Items : <strong>{{ $qty }}</strong></p>
        <p>Total Price :
            <strong>Rp{{ number_format($subtotal,0,',','.') }}</strong>
        </p>
    </div>
@endif


   <form action="{{ route('payment.index') }}" method="POST">
    @csrf

    {{-- INSTANT CHECKOUT --}}
    @isset($product)
        <input type="hidden" name="type" value="instant">
        <input type="hidden" name="product_id" value="{{ $product->id }}">
        <input type="hidden" name="qty" value="{{ $qty }}">
        <input type="hidden" name="total" value="{{ $subtotal }}">
    @endisset

    {{-- CART CHECKOUT --}}
    @isset($items)
        <input type="hidden" name="type" value="cart">
        <input type="hidden" name="total" value="{{ $totalPrice }}">

        @foreach($items as $item)
            <input type="hidden" name="cart_ids[]" value="{{ $item->cart_id }}">
        @endforeach
    @endisset

        <!-- SHIPPING ADDRESS -->
        <div class="section">
            <label><strong>Shipping Address</strong></label>
            <textarea
                id="shipping_address"
                name="shipping_address"
                rows="4"
                placeholder="Masukkan alamat lengkap pengiriman"
                required>
            </textarea>
            <button
                type="button"
                onclick="fillDefaultAddress()"
                style="
                    margin-top:10px;
                    background:#3498db;
                    padding:8px 15px;
                    border:none;
                    color:white;
                    border-radius:8px;
                    cursor:pointer;
                    font-size:13px;">
                📍 My Default Location
            </button>
        </div>

        <!-- PAYMENT METHOD (DUMMY DULU) -->
        <div style="margin-top:25px;">
            <label style="font-weight:600;">Payment Method</label><br>
            <select name="id_method" required
                style="width:100%; padding:10px; border-radius:8px; margin-top:8px;">
                <option value="">-- Select Payment Method --</option>
                @foreach($paymentMethods as $method)
                    <option value="{{ $method->id_method }}">
                        {{ $method->method_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <br>
        <a href="{{ route('cart') }}" class="btn-back">
            ← Back
        </a>

            <button type="submit" class="btn-confirm">
                Confirm Checkout
            </button>
        </div>    
    </form>
</div>

<script>
    function fillDefaultAddress() {
        const defaultAddress = @json($userAddress);

        if (!defaultAddress) {
            alert('Kamu belum menyimpan alamat default di profile.');
            return;
        }

        document.getElementById('shipping_address').value = defaultAddress;
    }
</script>


</body>
</html>
