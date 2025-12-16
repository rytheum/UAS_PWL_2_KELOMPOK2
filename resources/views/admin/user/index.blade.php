@extends('layouts.main')

@section('content')

@section('title', 'Admin - User')
@section('page-title', 'User')

    {{-- Alert --}}
    @if (session('success'))
        <div style="background:#d4edda;color:#155724;padding:10px 15px;border-radius:5px;margin-bottom:15px;">
            {{ session('success') }}
        </div>
    @endif

    <div style="background:white;padding:20px;border-radius:20px;">

        {{-- Button --}}
        <div style="margin-bottom:20px;">
            <a href="{{ route('admin.user.create') }}" style="
                            background:#2ecc71;
                            color:white;
                            padding:10px 18px;
                            border-radius:12px;
                            text-decoration:none;
                            font-weight:600;
                            display:inline-block;
                       ">
                Tambah User +
            </a>
        </div>


        <table style="width:100%;border-collapse:collapse;color:#333;">
            <thead style="background:#f8f9fa;">
                <tr>
                    <th style="padding:12px;">No</th>
                    <th style="padding:12px;text-align:left;">Nama</th>
                    <th style="padding:12px;text-align:left;">Email</th>
                    <th style="padding:12px;">Role</th>
                    <th style="padding:12px;text-align:center;">Action</th>
                </tr>
            </thead>

                @forelse ($users as $user)
                    <tr style="border-top:1px solid #dee2e6;">
                        <td style="padding:12px;">
                            {{ $users->firstItem() + $loop->index }}
                        </td>

                        <td style="padding:12px;">{{ $user->name }}</td>
                        <td style="padding:12px;">{{ $user->email }}</td>

                        <td style="padding:12px;">
                            <span style="
                                    padding:4px 10px;
                                    border-radius:12px;
                                    background: {{ $user->role === 'admin' ? '#e3f2fd' : '#e8f5e9' }};
                                    color: {{ $user->role === 'admin' ? '#0d47a1' : '#1b5e20' }};
                                ">
                                {{ ucfirst($user->role) }}
                            </span>
                        </td>

                        <td style="padding:12px;">
                            <div style="display:flex;justify-content:center;gap:8px;">

                                {{-- Show --}}
                                <a href="{{ route('admin.user.show', $user) }}" style="
                                    width:34px;
                                    height:34px;
                                    background:#3498db;
                                    color:white;
                                    border-radius:8px;
                                    display:flex;
                                    align-items:center;
                                    justify-content:center;
                                    text-decoration:none;
                                ">
                                    <i class="fa fa-eye"></i>
                                </a>

                                {{-- Edit --}}
                                <a href="{{ route('admin.user.edit', $user) }}" style="
                                    width:34px;
                                    height:34px;
                                    background:#f1c40f;
                                    color:white;
                                    border-radius:8px;
                                    display:flex;
                                    align-items:center;
                                    justify-content:center;
                                    text-decoration:none;
                                ">
                                    <i class="fa fa-pen"></i>
                                </a>

                                {{-- Delete --}}
                                <form action="{{ route('admin.user.destroy', $user) }}"
                                    method="POST"
                                    class="form-delete">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                        data-name="{{ $user->name }}"
                                        style="
                                            width:34px;
                                            height:34px;
                                            background:#e74c3c;
                                            color:white;
                                            border:none;
                                            border-radius:8px;
                                            cursor:pointer;
                                        ">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>

                            </div>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="padding:20px;text-align:center;">
                            Tidak ada data user.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Pagination --}}
        <div style="margin-top:20px;">
            {{ $users->links() }}
        </div>

    </div>

@endsection