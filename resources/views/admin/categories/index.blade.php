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
        <a href="{{ route('admin.categories.create') }}" style="
                                background:#2ecc71;
                                color:white;
                                padding:10px 18px;
                                border-radius:12px;
                                text-decoration:none;
                                font-weight:600;
                                display:inline-block;
                           ">
            Tambah Category +
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

                        <td style="padding:12px;">
                            <div style="display:flex;justify-content:center;gap:8px;">

                                {{-- Show --}}
                                <a href="{{ route('admin.categories.show', $category) }}" style="
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
                                <a href="{{ route('admin.categories.edit', $category) }}" style="
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
                                <form action="{{ route('admin.categories.destroy', $category) }}"
                                    method="POST"
                                    class="form-delete">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                        data-name="{{ $category->name }}"
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
                        <td colspan="3" style="padding:20px;text-align:center;">
                            Tidak ada data category.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        </div>

@endsection