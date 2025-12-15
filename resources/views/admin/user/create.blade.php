@extends('layouts.main')

@section('title', 'Admin - Create User')
@section('page-title', 'TAMBAH USER BARU')

@section('content')

    <div class="box" style="background: white; padding: 20px; border-radius: 20px; color: #333;">

        <form action="{{ route('admin.user.store') }}" method="POST">
            @csrf

            <div style="margin-bottom: 15px;">
                <label for="name" style="display: block; margin-bottom: 5px; font-weight: bold;">Nama:</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required
                    style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                @error('name') <small style="color: red;">{{ $message }}</small> @enderror
            </div>

            <div style="margin-bottom: 15px;">
                <label for="email" style="display: block; margin-bottom: 5px; font-weight: bold;">Email:</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required
                    style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                @error('email') <small style="color: red;">{{ $message }}</small> @enderror
            </div>

            <div style="margin-bottom: 15px;">
                <label for="password" style="display: block; margin-bottom: 5px; font-weight: bold;">Password:</label>
                <input type="password" id="password" name="password" required
                    style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                @error('password') <small style="color: red;">{{ $message }}</small> @enderror
            </div>

            <div style="margin-bottom: 15px;">
                <label for="password_confirmation" style="display: block; margin-bottom: 5px; font-weight: bold;">Konfirmasi
                    Password:</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required
                    style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
            </div>

            <div style="margin-bottom: 20px;">
                <label for="role" style="display: block; margin-bottom: 5px; font-weight: bold;">Role:</label>
                <select id="role" name="role" required
                    style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                    <option value="customer" {{ old('role') == 'customer' ? 'selected' : '' }}>Customer</option>
                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
                @error('role') <small style="color: red;">{{ $message }}</small> @enderror
            </div>

            <button type="submit"
                style="background: #28a745; color: white; padding: 10px 20px; border-radius: 5px; border: none; cursor: pointer;">
                Simpan User
            </button>
            <a href="{{ route('admin.user.index') }}"
                style="background: #6c757d; color: white; padding: 10px 20px; border-radius: 5px; text-decoration: none;">
                Batal
            </a>
        </form>

    </div>

@endsection