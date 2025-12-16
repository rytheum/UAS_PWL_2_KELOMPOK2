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

    {{-- PRODUK + JUMLAH --}}
    <div class="form-row">

        <div class="form-group">
            <label class="form-label">Produk</label>
            <select name="id_product[]" class="form-select">
                <option value="">Pilih Produk</option>
                {{-- nanti looping product --}}
                <option value="1">Produk A</option>
                <option value="2">Produk B</option>
            </select>
        </div>

        <div class="form-group">
            <label class="form-label">Jumlah</label>
            <input type="number"
                   name="items_amount[]"
                   class="form-input"
                   placeholder="Tentukan Jumlah"
                   min="1">
        </div>

        {{-- BUTTON PLUS --}}
        <div style="display:flex;align-items:flex-end;">
            <button type="button"
                    style="
                        background:#22c55e;
                        color:white;
                        border:none;
                        width:40px;
                        height:40px;
                        border-radius:8px;
                        font-size:22px;
                        cursor:pointer;
                    ">
                +
            </button>
        </div>

    </div>

    {{-- STATUS --}}
    <div class="form-group">
        <label class="form-label">Status</label>
        <select name="id_payment_status" class="form-select">
            <option value="1">Belum Dibayar</option>
            <option value="2">Diproses</option>
            <option value="3">Selesai</option>
        </select>
    </div>

    {{-- ACTION --}}
    <div class="form-actions">
        <button type="submit" class="btn-success">
            Tambah +
        </button>

        <a href="{{ route('admin.transactions.index') }}" class="btn-danger">
            &lt; Kembali
        </a>
    </div>

</form>

@endsection
