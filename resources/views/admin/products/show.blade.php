@extends('layouts.app')

@section('title', 'Product Detail')
@section('page-title', 'Product Detail')

@section('content')

<div style="display: grid; grid-template-columns: 1fr 2fr; gap: 30px; align-items: center;">

    {{-- IMAGE --}}
    <div style="text-align: center;">
        <img 
            src="{{ $product->image 
                ? asset('storage/images/' . $product->image) 
                : asset('images/no-image.png') }}"
                style="
                    width: 300px;
                    height: auto;
                    border-radius: 12px;
                    object-fit: cover;
                "
            alt="{{ $product->title }}">
    </div>

    {{-- INFO --}}
    <div>
        <h2 style="margin-bottom: 20px;">
            {{ $product->title }}
        </h2>

        <p><strong>Category:</strong><br>
            {{ $product->category->category_name ?? '-' }}
        </p>

        <p><strong>Price:</strong><br>
            Rp {{ number_format($product->price, 0, ',', '.') }}
        </p>

        <p><strong>Stock:</strong><br>
            {{ $product->stock }}
        </p>

        <p><strong>Description:</strong><br>
            {{ $product->description }}
        </p>

        <a href="{{ route('admin.products.index') }}" class="btn-danger">
            &lt; Kembali
        </a>
    </div>

</div>

@endsection
