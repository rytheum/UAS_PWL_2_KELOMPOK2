@extends('layouts.main')

@section('title', 'Admin Dashboard')
@section('page-title', 'PRODUCTS')

@section('content')

{{-- TOP ACTION --}}
<section class="cards" style="grid-template-columns: 1fr;">
  <div class="card">
    <small>Total Product</small>
    <h2>{{ $products->total() }} Item</h2>
    <a href="{{ route('admin.products.create') }}">Tambah Product</a>
  </div>
</section>

{{-- TABLE --}}
<section class="bottom">
  <div class="box" style="width:100%; overflow-x:auto;">

    @if (session('success'))
      <div style="margin-bottom:15px; color:green;">
        {{ session('success') }}
      </div>
    @endif

    <table width="100%" cellpadding="10" cellspacing="0">
      <thead>
        <tr style="background:#f5f5f5; text-align:left;">
          <th>Image</th>
          <th>Title</th>
          <th>Category</th>
          <th>Price</th>
          <th>Stock</th>
          <th width="160">Action</th>
        </tr>
      </thead>

      <tbody>
        @forelse ($products as $product)
          <tr style="border-bottom:1px solid #eee;">
            <td>
              <img
                src="{{ asset('storage/images/'.$product->image) }}"
                width="60"
                style="border-radius:6px"
              >
            </td>
            <td>{{ $product->title }}</td>
            <td>{{ $product->product_categories_name }}</td>
            <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
            <td>{{ $product->stock }}</td>
            <td>
              <a href="{{ route('admin.products.show', $product->id) }}">
                👁
              </a>
              |
              <a href="{{ route('admin.products.edit', $product->id) }}">
                ✏
              </a>
              |
              <form
                action="{{ route('admin.products.destroy', $product->id) }}"
                method="POST"
                style="display:inline"
                onsubmit="return confirm('Yakin hapus data?')"
              >
                @csrf
                @method('DELETE')
                <button type="submit" style="background:none;border:none;color:red;cursor:pointer">
                  🗑
                </button>
              </form>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="6" style="text-align:center;">
              Data product belum ada
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>

    {{-- PAGINATION --}}
    <div style="margin-top:20px;">
      {{ $products->links() }}
    </div>

  </div>
</section>

@endsection
