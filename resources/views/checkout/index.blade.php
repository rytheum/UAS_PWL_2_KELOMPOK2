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
    <h2>Checkout Detail</h2>

    <div class="item">
        <img src="{{ asset('storage/images/' . $product->image) }}">

        <div style="flex:1">
            <h3>{{ $product->title }}</h3>
            <p>Quantity : <strong>{{ $qty }}</strong></p>
        </div>

        <div>
            <p>Price</p>
            <strong>Rp{{ number_format($product->price,0,',','.') }}</strong>
        </div>
    </div>

    <div class="summary">
        <p>Total Items : <strong>{{ $qty }}</strong></p>
        <p>Total Price :
            <strong>Rp{{ number_format($subtotal,0,',','.') }}</strong>
        </p>
    </div>

    <form action="{{ route('payment.index') }}" method="POST">
        @csrf
        <input type="hidden" name="product_id" value="{{ $product->id }}">
        <input type="hidden" name="qty" value="{{ $qty }}">

        <!-- SHIPPING ADDRESS -->
        <div class="section">
            <label><strong>Shipping Address</strong></label>
            <textarea
                name="shipping_address"
                rows="4"
                placeholder="Masukkan alamat lengkap pengiriman"
                required
            ></textarea>
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
        <div class="action">
            <a href="{{ url()->previous() }}" class="btn-back">
                ← Back
            </a>

            <button type="submit" class="btn-confirm">
                Confirm Checkout
            </button>
        </div>    
    </form>
</div>

</body>
</html>
