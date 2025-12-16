@extends('layouts.main')

@section('content')

    <h2 style="margin-bottom:20px;">User Management</h2>

    {{-- Alert --}}
    @if (session('success'))
        <div style="background:#d4edda;color:#155724;padding:10px 15px;border-radius:5px;margin-bottom:15px;">
            {{ session('success') }}
        </div>
    @endif

    <div style="background:white;padding:20px;border-radius:20px;">

        <div style="margin-bottom:15px;text-align:right;">
            <a href="{{ route('admin.user.create') }}"
                style="background:#28a745;color:white;padding:8px 14px;border-radius:6px;text-decoration:none;">
                + Tambah User
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

            <tbody>
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

                        <td style="padding:12px;text-align:center;">
                            <a href="{{ route('admin.user.show', $user) }}"
                                style="background:#007bff;color:white;padding:6px 10px;border-radius:5px;text-decoration:none;">
                                View
                            </a>

                            <a href="{{ route('admin.user.edit', $user) }}"
                                style="background:#ffc107;color:#333;padding:6px 10px;border-radius:5px;text-decoration:none;margin:0 5px;">
                                Edit
                            </a>

<form action="{{ route('admin.user.destroy', $user) }}"
      method="POST"
      class="form-delete"
      style="display:inline;">
    @csrf
    @method('DELETE')

    <button type="submit"
        data-name="{{ $user->name }}"
        style="background:#dc3545;color:white;padding:6px 10px;border-radius:5px;border:none;">
        Delete
    </button>
</form>


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