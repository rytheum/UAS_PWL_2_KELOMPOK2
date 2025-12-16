@extends('layouts.app')

@section('title', 'Admin - Edit User')
@section('page-title', 'Edit User')

@section('content')

    <form action="{{ route('admin.user.update', $user) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label class="form-label">Nama</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-input" required>
            @error('name')
                <div class="form-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-label">Email</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-input" required>
            @error('email')
                <div class="form-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-label">
                Password
                <small style="font-weight:400;color:#999;">(kosongkan jika tidak diubah)</small>
            </label>
            <input type="password" name="password" class="form-input">
            @error('password')
                <div class="form-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-label">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" class="form-input">
        </div>

        <div class="form-group">
            <label class="form-label">Role</label>
            <select name="role" class="form-select" required>
                <option value="customer" {{ old('role', $user->role) == 'customer' ? 'selected' : '' }}>
                    Customer
                </option>
                <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>
                    Admin
                </option>
            </select>
            @error('role')
                <div class="form-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-success">
                Simpan Perubahan
            </button>

            <a href="{{ route('admin.user.index') }}" class="btn-danger">
                Kembali
            </a>
        </div>
    </form>

@endsection