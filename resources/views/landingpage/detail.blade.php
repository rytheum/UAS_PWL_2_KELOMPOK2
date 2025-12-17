<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>{{ $product->title }}</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #fff;
        }

        .container {
            display: flex;
            gap: 40px;
            margin: 60px auto;
            width: 900px;
        }

        .image-box {
            border: 1px solid #ddd;
            padding: 20px;
        }

        .image-box img {
            width: 350px;
        }

        .label {
            color: #5b6cff;
            font-weight: 600;
        }

        .price-stock {
            display: flex;
            justify-content: space-between;
            margin: 20px 0;
        }

        .qty {
            display: flex;
            gap: 15px;
            border: 1px solid #ccc;
            padding: 8px 16px;
            border-radius: 20px;
            width: fit-content;
        }

        .btn {
            padding: 12px 22px;
            border-radius: 10px;
            border: none;
            color: #fff;
            cursor: pointer;
            text-decoration: none;
        }

        .checkout {
            background: #6bd26b;
        }

        .cart {
            background: #6b7cff;
        }

        .back {
            background: #444;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="image-box">
            <img src="{{ asset('storage/images/' . $product->image) }}" alt="{{ $product->title }}">
        </div>

        <div>
            <span class="label">Product Name:</span>
            <h1>{{ $product->title }}</h1>

            <div class="price-stock">
                <div>
                    <span class="label">Price:</span>
                    <h2>Rp {{ number_format($product->price, 0, ',', '.') }}</h2>
                </div>
                <div>
                    <span class="label">Stock</span>
                    <h2>{{ $product->stock }}</h2>
                </div>
            </div>

            <span class="label">Description:</span>
            <p>{{ $product->description }}</p>

            <span class="label">Amount:</span>
            <div class="qty">
                <span id="minus" style="cursor:pointer;">-</span>
                <span id="quantity">1</span>
                <span id="plus" style="cursor:pointer;">+</span>
            </div>


            <div style="margin-top: 30px; display: flex; gap: 15px;">
                <button class="btn checkout">CheckOut</button>
                <button class="btn cart">Add To Cart</button>
                <a href="{{ route('landing') }}" class="btn back">Back</a>
            </div>
        </div>
    </div>

<script>
    const minus = document.getElementById('minus');
    const plus = document.getElementById('plus');
    const quantity = document.getElementById('quantity');

    let count = 1;
    const stock = {{ $product->stock }}; // ambil stock dari backend

    minus.addEventListener('click', () => {
        if(count > 1) { // minimal 1
            count--;
            quantity.textContent = count;
        }
    });

    plus.addEventListener('click', () => {
        if(count < stock) { // maksimal stok
            count++;
            quantity.textContent = count;
        }
    });
</script>


</body>

</html>