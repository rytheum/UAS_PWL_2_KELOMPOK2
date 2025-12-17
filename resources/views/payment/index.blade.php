<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Payment</title>

    <style>
        /* ===== Reset & Base ===== */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f6fa;
            color: #333;
        }

        h2, h3 {
            color: #2c3e50;
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
        }

        .container {
            max-width: 720px;
            margin: 60px auto;
            padding: 0 20px;
        }

        /* ===== Box Styles ===== */
        .box {
            background: #fff;
            border-radius: 15px;
            padding: 30px 25px;
            margin-bottom: 30px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .box:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.12);
        }

        .rekening {
            background: #f9f9f9;
            padding: 20px;
            border-radius: 12px;
            border: 1px solid #e0e0e0;
        }

        .rekening p {
            margin: 10px 0;
            font-size: 16px;
        }

        input[type="file"] {
            margin-top: 10px;
            padding: 8px;
            border-radius: 8px;
            border: 1px solid #ccc;
            width: 100%;
        }

        /* ===== Buttons ===== */
        .btn {
            padding: 12px 28px;
            border-radius: 10px;
            border: none;
            cursor: pointer;
            color: #fff;
            font-size: 15px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-confirm {
            background: #27ae60;
        }

        .btn-confirm:hover {
            background: #1e8449;
            transform: translateY(-2px);
        }
    </style>
</head>

<body>

<div class="container">

    <h2>Payment Instruction</h2>

    <!-- INFO REKENING -->
    <div class="box">
        <h3>Transfer To</h3>
        <div class="rekening">
            <p><strong>Bank :</strong> {{ $paymentMethod->method_name }}</p>
            <p><strong>No Rekening :</strong> 1234567890</p>
            <p><strong>Atas Nama :</strong> PT E-Commerce Indonesia</p>
            <p><strong>Total Payment :</strong> Rp {{ number_format($total,0,',','.') }}</p>
        </div>
    </div>

    <!-- UPLOAD BUKTI -->
    <div class="box">
        <h3>Upload Payment Proof</h3>

        <form action="{{ route('payment.process') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- WAJIB: kirim id payment method -->
            <input type="hidden" name="id_method" value="{{ $paymentMethod->id_method }}">

            <input type="file" name="payment_proof" required>
            <input type="hidden" name="product_id" value="{{ $product_id }}">
            <input type="hidden" name="qty" value="{{ $qty }}">
            <br><br>

            <button type="submit" class="btn btn-confirm">
                Confirm Payment
            </button>
        </form>
    </div>

</div>

</body>
</html>
