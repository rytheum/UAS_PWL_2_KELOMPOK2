@extends('layouts.app')

@section('title', 'Tambah Transaction')
@section('page-title', 'Tambah Transaction')

@section('content')

<form action="{{ route('admin.transactions.store') }}" method="POST">
@csrf

{{-- EMAIL --}}
<div class="form-group">
    <label class="form-label">Email Pembeli</label>
    <input type="email"
           name="email"
           class="form-input"
           placeholder="Masukkan Email"
           required>
</div>

{{-- TANGGAL --}}
<div class="form-group">
    <label class="form-label">Tanggal Pembelian</label>
    <input type="date"
           name="transaction_time"
           class="form-input"
           required>
</div>

<div id="product-wrapper">
    <div class="form-row product-item" style="display:flex; gap:10px; align-items:flex-end;">

        {{-- PRODUK --}}
        <div class="form-group" style="flex:3;">
            <label class="form-label">Produk</label>
            <select name="id_product[]" class="form-select" required>
                <option value="">Pilih Produk</option>
                @foreach ($products as $product)
                    <option value="{{ $product->id }}">
                        {{ $product->title }} (Stok: {{ $product->stock }})
                    </option>
                @endforeach
            </select>
        </div>

        {{-- JUMLAH --}}
        <div class="form-group" style="flex:2;">
            <label class="form-label">Jumlah</label>
            <input type="number"
                   name="items_amount[]"
                   class="form-input"
                   min="1"
                   required>
        </div>

        {{-- BUTTON --}}
        <div style="display:flex; gap:6px;">
            <button type="button"
                    class="btn-success"
                    onclick="addProduct()"
                    style="width:40px;height:40px;">
                +
            </button>

            <button type="button"
                    class="btn-danger"
                    onclick="removeProduct(this)"
                    style="width:40px;height:40px;">
                ×
            </button>
        </div>

    </div>

</div>

{{-- STATUS --}}
<div class="form-group">
    <label class="form-label">Status Pembayaran</label>
    <select name="id_payment_status" class="form-select" required>
        <option value="1">Belum Dibayar</option>
        <option value="2">Diproses</option>
        <option value="3">Selesai</option>
    </select>
</div>

{{-- PAYMENT METHOD --}}
<div class="form-group">
    <label class="form-label">Metode Pembayaran</label>
    <select name="id_method" class="form-select" required>
        <option value="">Pilih Metode Pembayaran</option>
        @foreach ($payment_methods as $method)
            <option value="{{ $method->id_method }}">
                {{ $method->method_name }}
            </option>
        @endforeach
    </select>
</div>

{{-- ACTION --}}
<div class="form-actions">
    <button type="submit" class="btn-success">
        Simpan Transaksi
    </button>

    <a href="{{ route('admin.transactions.index') }}" class="btn-danger">
        &lt; Kembali
    </a>
</div>

</form>

{{-- SCRIPT --}}
<script>
function addProduct() {
    let wrapper = document.getElementById('product-wrapper');
    let item = document.querySelector('.product-item').cloneNode(true);

    item.querySelectorAll('input, select').forEach(el => el.value = '');
    wrapper.appendChild(item);
}

function removeProduct(button) {
    let items = document.querySelectorAll('.product-item');
    if (items.length > 1) {
        button.closest('.product-item').remove();
    } else {
        alert('Minimal 1 produk');
    }
}
</script>

@endsection