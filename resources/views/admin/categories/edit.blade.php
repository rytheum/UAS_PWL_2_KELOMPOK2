@extends('layouts.app')

@section('title', 'Edit Category')
@section('page-title', 'Edit Category')

@section('content')

    <form action="{{ route('admin.categories.update', $category) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label class="form-label">Category</label>

            <input type="text" name="category_name" class="form-input"
                value="{{ old('category_name', $category->category_name) }}" placeholder="Nama Category" required>

            @error('category_name')
                <div class="form-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-success">
                Update
            </button>

            <a href="{{ route('admin.categories.index') }}" class="btn-danger">
                Batal
            </a>
        </div>
    </form>

@endsection