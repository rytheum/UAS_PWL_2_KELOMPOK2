@extends('layouts.main')

@section('title', 'Admin - Product')
@section('page-title', 'Product')

@section('content')

    <div style="
        background:white;
        border-radius:25px;
        padding:25px;
        box-shadow:0 10px 30px rgba(0,0,0,.15);
    ">

        {{-- Button --}}
        <div style="margin-bottom:20px;">
            <a href="{{ route('admin.products.create') }}" style="
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

        {{-- Table --}}
        <table style="width:100%;border-collapse:collapse;">
            <thead>
                <tr style="background:#eee;color:#555;font-size:13px;">
                    <th style="padding:12px;">Image</th>
                    <th style="padding:12px;">Title</th>
                    <th style="padding:12px;">Category</th>
                    <th style="padding:12px;">Price</th>
                    <th style="padding:12px;">Stock</th>
                    <th style="padding:12px;text-align:center;">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $product)
                    <tr style="border-bottom:1px solid #eee;">
                        <td style="padding:12px;">
                            <img src="{{ asset('storage/images/' . $product->image) }}" style="
                                        width:45px;
                                        height:45px;
                                        border-radius:10px;
                                        object-fit:cover;
                                     ">
                        </td>
                        <td style="padding:12px;">
                            {{ $product->title }}
                        </td>
                        <td style="padding:12px;">
                            {{ $product->product_categories_name ?? '-' }}
                        </td>
                        <td style="padding:12px;">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </td>
                        <td style="padding:12px;">
                            {{ $product->stock }}
                        </td>
                        <td style="padding:12px;">
                            <div style="display:flex;justify-content:center;gap:8px;">

                                {{-- View --}}
                                <a href="{{ route('admin.products.show', $product->id) }}" style="
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
                                <a href="{{ route('admin.products.edit', $product->id) }}" style="
                                            width:34px;
                                            height:34px;
                                            background:#f1c40f;
                                            color:#333;
                                            border-radius:8px;
                                            display:flex;
                                            align-items:center;
                                            justify-content:center;
                                            text-decoration:none;
                                       ">
                                    <i class="fa fa-pen"></i>
                                </a>

                                {{-- Delete --}}
                                <form action="{{ route('admin.products.destroy', $product->id) }}"
                                    method="POST"
                                    class="form-delete">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        data-name="{{ $product->title }}"
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
                        <td colspan="6" style="padding:20px;text-align:center;color:#777;">
                            Tidak ada product
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Pagination --}}
        <div style="margin-top:20px;">
            {{ $products->links() }}
        </div>

    </div>

@endsection