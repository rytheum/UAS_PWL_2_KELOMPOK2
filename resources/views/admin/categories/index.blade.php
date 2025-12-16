@extends('layouts.main')

@section('title', 'Admin Dashboard')
@section('page-title', 'Categories')

@section('content')


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
            Tambah Product +
        </a>
    </div>

            <table style="width:100%;border-collapse:collapse;color:#333;">
                <thead style="background:#f8f9fa;">
                    <tr>
                        <th style="padding:12px;">ID</th>
                        <th style="padding:12px;text-align:left;">Category</th>
                        <th style="padding:12px;text-align:center;">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($categories as $category)
                        <tr style="border-top:1px solid #dee2e6;">
                            <td style="padding:12px;">
                                {{ $loop->iteration }}
                            </td>

                            <td style="padding:12px;">
                                {{ $category->category_name }}
                            </td>

                        <td style="padding:12px;text-align:center;">
                            <a href="{{ route('admin.categories.show', $category->id) }}"
                                style="background:#007bff;color:white;padding:6px 10px;border-radius:5px;text-decoration:none;">
                                View
                            </a>

                            <a href="{{ route('admin.categories.edit', $category->id) }}"
                                style="background:#ffc107;color:#333;padding:6px 10px;border-radius:5px;text-decoration:none;margin:0 5px;">
                                Edit
                            </a>

                            <form action="{{ route('admin.categories.destroy', $category->id) }}"
                                  method="POST"
                                  style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    onclick="return confirm('Hapus category {{ $category->name }}?')"
                                    style="background:#dc3545;color:white;padding:6px 10px;border-radius:5px;border:none;">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" style="padding:20px;text-align:center;">
                            Tidak ada data category.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        </div>

@endsection