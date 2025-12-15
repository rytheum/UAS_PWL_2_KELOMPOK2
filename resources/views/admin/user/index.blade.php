@extends('layouts.main')

@section('title', 'Admin - User Tables')
@section('page-title', 'TABLES')

@section('content')

    {{-- Notifikasi Sukses/Error (Opsional) --}}
    @if (session('success'))
        <div style="background-color: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 20px;">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div style="background-color: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px; margin-bottom: 20px;">
            {{ session('error') }}
        </div>
    @endif

    {{-- Tombol Tambah Admin --}}
    <a href="{{ route('admin.user.create') }}"
        style="background: #28a745; color: white; padding: 10px 20px; border-radius: 5px; text-decoration: none; display: inline-block; margin-bottom: 20px;">
        <i class="fa fa-plus"></i> Tambah Admin
    </a>

    {{-- Kotak Tabel --}}
    <div class="box" style="background: white; padding: 20px; border-radius: 20px;">

        {{-- Tabel --}}
        <table style="width: 100%; border-collapse: collapse; color: #333;">
            <thead style="background-color: #f8f9fa;">
                <tr>
                    <th style="padding: 12px; text-align: left;">Id</th>
                    <th style="padding: 12px; text-align: left;">User</th>
                    <th style="padding: 12px; text-align: left;">Role</th>
                    <th style="padding: 12px; text-align: center;">Action</th>
                </tr>
            </thead>
            <tbody>

                {{-- Cek apakah ada data user --}}
                @forelse ($users as $user)
                    <tr style="border-top: 1px solid #dee2e6;">
                        {{-- ID (Menggunakan $loop->iteration untuk penomoran 01, 02, ...) --}}
                        <td style="padding: 12px;">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</td>

                        {{-- Nama User --}}
                        <td style="padding: 12px;">{{ $user->name }}</td>

                        {{-- Role (Dikonversi ke Huruf Kapital) --}}
                        <td style="padding: 12px;">{{ ucfirst($user->role) }}</td>

                        {{-- Action Buttons --}}
                        <td style="padding: 12px; text-align: center;">

                            {{-- View/Show (Tanda Mata) --}}
                            <a href=""
                                style="background: #007bff; color: white; padding: 6px 10px; border-radius: 5px; text-decoration: none; margin-right: 5px;">
                                <i class="fa fa-eye"></i>
                            </a>

                            {{-- Edit (Tanda Pensil) --}}
                            <a href=""
                                style="background: #ffc107; color: #333; padding: 6px 10px; border-radius: 5px; text-decoration: none; margin-right: 5px;">
                                <i class="fa fa-pencil-alt"></i>
                            </a>

                            {{-- Delete (Tanda Tempat Sampah) --}}
                            <form action="" method="POST"
                                style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    style="background: #dc3545; color: white; padding: 6px 10px; border-radius: 5px; border: none; cursor: pointer;"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?')">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>

                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" style="padding: 12px; text-align: center;">Tidak ada data user.</td>
                    </tr>
                @endforelse

            </tbody>
        </table>
    </div>

@endsection