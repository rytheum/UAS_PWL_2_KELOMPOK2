@extends('layouts.app')

@section('title', 'Tambah Product')
@section('page-title', 'Edit Product')

@section('content')

<form method="POST"
    action="{{ route('admin.products.update', $data['product']->id) }}"
    enctype="multipart/form-data">

    @csrf
    @method('PUT')

    {{-- IMAGE --}}
    <div class="form-group">
        <label class="form-label">Images</label>
        <input type="file" name="image"
            class="form-input @error('image') is-invalid @enderror">
        @error('image')
            <div class="form-error">{{ $message }}</div>
        @enderror

        @if($data['product']->image)
            <img src="{{ asset('storage/images/'.$data['product']->image) }}"
                style="max-width:200px;border-radius:12px">
        @endif
    </div>

    {{-- PRODUCT CATEGORY --}}
    <div class="form-group">
        <label class="form-label">Product Category</label>
        <select name="product_category"
            class="form-select @error('product_category') is-invalid @enderror">
            <option value="">Select Product Category</option>
             @foreach($data['categories'] as $category)
            <option value="{{ $category->id }}"
                {{ old('product_category', $data['product']->product_category_id) == $category->id ? 'selected' : '' }}>
                {{ $category->category_name }}
            </option>
        @endforeach
        </select>
        @error('product_category')
            <div class="form-error">{{ $message }}</div>
        @enderror
    </div>

    {{-- TITLE --}}
    <div class="form-group">
        <label class="form-label">Title</label>
        <input type="text" name="title"
            value="{{ old('title', $data['product']->title) }}"
            class="form-input @error('title') is-invalid @enderror"
            placeholder="Masukkan Title Product">
        @error('title')
            <div class="form-error">{{ $message }}</div>
        @enderror
    </div>

    {{-- DESCRIPTION --}}
    <div class="form-group">
        <label class="form-label">Description</label>
        <textarea name="description"
            class="form-textarea @error('description') is-invalid @enderror"
            placeholder="Tambahkan Deskripsi Product">{{ old('description', $data['product']->description) }}</textarea>
        @error('description')
            <div class="form-error">{{ $message }}</div>
        @enderror
    </div>

    {{-- PRICE & STOCK --}}
    <div class="form-row">
        <div class="form-group">
            <label class="form-label">Price</label>
            <input type="number" name="price"
                value="{{ old('price', $data['product']->price) }}"
                class="form-input @error('price') is-invalid @enderror"
                placeholder="Masukkan Harga">
            @error('price')
                <div class="form-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-label">Stock</label>
            <input type="number" name="stock"
                value="{{ old('stock', $data['product']->stock) }}"
                class="form-input @error('stock') is-invalid @enderror"
                placeholder="Masukkan Stock">
            @error('stock')
                <div class="form-error">{{ $message }}</div>
            @enderror
        </div>
    </div>

    {{-- BUTTON --}}
    <div class="form-actions">
        <button type="submit" class="btn-success">
            Edit +
        </button>
        <a href="{{ route('admin.products.index') }}" class="btn-danger">
            &lt; Kembali
        </a>
    </div>

</form>

@endsection
