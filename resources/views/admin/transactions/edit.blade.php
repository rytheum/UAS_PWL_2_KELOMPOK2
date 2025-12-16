@extends('layouts.app')

@section('title', 'Edit Transaction')
@section('page-title', 'Edit Transaction')

@section('content')

<form action="{{ route('admin.transactions.update', $transaction->id_transaction) }}" method="POST">
    @csrf
    @method('PUT')

    {{-- EMAIL --}}
    <div class="form-group">
        <label class="form-label">Email Pembeli</label>
        <input type="email"
               name="email"
               value="{{ old('email', optional($transaction->user)->email) }}"
               class="form-input"
               placeholder="Masukkan Email"
               required>
    </div>

    {{-- TANGGAL --}}
    <div class="form-group">
        <label class="form-label">Tanggal Pembelian</label>
        <input type="date"
               name="transaction_time"
               value="{{ old('transaction_time', \Carbon\Carbon::parse($transaction->transaction_time)->format('Y-m-d')) }}"
               class="form-input"
               required>
    </div>

    {{-- PRODUK + JUMLAH --}}
    @foreach ($transaction->details as $index => $detail)
    <div class="form-row">

        <div class="form-group">
        <label class="form-label">Produk</label>
        <select name="id_product[]" class="form-select">
            <option value="">Pilih Produk</option>

            @foreach ($products as $product)
                <option value="{{ $product->id }}"
                    {{ old('id_product.'.$index, $detail->product_id) == $product->id ? 'selected' : '' }}>
                    {{ $product->title }} (Stok: {{ $product->stock }})
                </option>
            @endforeach

        </select>
    </div>

        <div class="form-group">
            <label class="form-label">Jumlah</label>
            <input type="number"
                   name="items_amount[]"
                   value="{{ old('items_amount.'.$index, $detail->items_amount) }}"
                   class="form-input"
                   min="1">
        </div>

    </div>
    @endforeach

    {{-- STATUS --}}
    <div class="form-group">
        <label class="form-label">Status</label>
        <select name="id_payment_status" class="form-select">
            <option value="1" {{ old('id_payment_status', $transaction->id_payment_status) == 1 ? 'selected' : '' }}>
                Belum Dibayar
            </option>
            <option value="2" {{ old('id_payment_status', $transaction->id_payment_status) == 2 ? 'selected' : '' }}>
                Diproses
            </option>
            <option value="3" {{ old('id_payment_status', $transaction->id_payment_status) == 3 ? 'selected' : '' }}>
                Selesai
            </option>
        </select>
    </div>

    {{-- PAYMENT METHOD --}}
    <div class="form-group">
        <label class="form-label">Metode Pembayaran</label>
        <select name="id_method" class="form-select" required>
            <option value="">Pilih Metode Pembayaran</option>
            @foreach ($payment_methods as $method)
                <option value="{{ $method->id_method }}"
                    {{ old('id_method', $transaction->id_method) == $method->id_method ? 'selected' : '' }}>
                    {{ $method->method_name }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- ACTION --}}
    <div class="form-actions">
        <button type="submit" class="btn-success">
            Update
        </button>

        <a href="{{ route('admin.transactions.index') }}" class="btn-danger">
            &lt; Kembali
        </a>
    </div>

</form>

@endsection