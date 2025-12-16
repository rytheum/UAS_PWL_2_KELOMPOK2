@extends('layouts.app')

@section('title', 'Tambah Category')
@section('page-title', 'Tambah Category')

@section('content')

    <form action="{{ route('admin.categories.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label class="form-label">
                Category
            </label>

            <input type="text" name="category_name" class="form-input" placeholder="Nama Category"
                value="{{ old('category_name') }}" required>

            @error('category_name')
                <div class="form-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-success">
                Tambah +
            </button>

            <a href="{{ route('admin.categories.index') }}" class="btn-danger">
                Batal
            </a>
        </div>

    </form>

@endsection