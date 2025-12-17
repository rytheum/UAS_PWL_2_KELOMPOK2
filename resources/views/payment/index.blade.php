<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Payment</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #fff;
        }

        .container {
            width: 700px;
            margin: 60px auto;
        }

        .box {
            border: 1px solid #ddd;
            border-radius: 12px;
            padding: 25px;
            margin-bottom: 25px;
        }

        h2 {
            margin-bottom: 20px;
        }

        .rekening {
            background: #f9f9f9;
            padding: 18px;
            border-radius: 10px;
        }

        .rekening p {
            margin: 8px 0;
            font-size: 16px;
        }

        input[type="file"] {
            margin-top: 10px;
        }

        .action {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
        }

        .btn {
            padding: 12px 30px;
            border-radius: 10px;
            border: none;
            cursor: pointer;
            color: #fff;
            text-decoration: none;
            font-size: 15px;
        }

        .btn-back {
            background: #e74c3c;
        }

        .btn-back:hover {
            background: #c0392b;
        }

        .btn-confirm {
            background: #6bd26b;
        }

        .btn-confirm:hover {
            background: #58b958;
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

            <label><strong>Payment Method</strong></label>
            <p>
                {{ $paymentMethod->method_name }} - 1234567890 a.n PT E-Commerce Indonesia
            </p>

            <br>

            <label><strong>Upload Bukti Pembayaran</strong></label><br>
            <input type="file" name="payment_proof" required>

            <br><br>

            <button type="submit" class="btn btn-confirm">
                Confirm Payment
            </button>
        </form>
    </div>

</div>

</body>
</html>
