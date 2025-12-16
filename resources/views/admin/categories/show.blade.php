@extends('layouts.app')

@section('title', 'Detail Category')
@section('page-title', 'Detail Category')

@section('content')

    <div class="form-group">
        <label class="form-label">Nama Category</label>

        <input type="text" class="form-input" value="{{ $category->category_name }}" disabled>
    </div>

    <div class="form-group">
        <label class="form-label">Jumlah Product</label>

        <input type="text" class="form-input" value="{{ $category->products()->count() }}" disabled>
    </div>


        <a href="{{ route('admin.categories.index') }}" class="btn-danger">
            Kembali
        </a>
    </div>

@endsection