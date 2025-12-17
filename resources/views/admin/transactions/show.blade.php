@extends('layouts.app')

@section('title', 'Detail Transaction')
@section('page-title', 'Detail Transaction')

@section('content')

{{-- ================= HEADER TRANSAKSI ================= --}}
<div class="form-group">
    <p>
        <strong>ID Transaksi</strong><br>
        {{ $transaction->id_transaction }}
    </p>

    <p>
        <strong>Email Pembeli</strong><br>
        {{ $transaction->user->email ?? '-' }}
    </p>

    <p>
        <strong>Tanggal Pembelian</strong><br>
        {{ \Carbon\Carbon::parse($transaction->transaction_time)->format('d M Y') }}
    </p>

    <p>
        <strong>Status Pembayaran</strong><br>
        {{ $transaction->paymentStatus->status_name ?? '-' }}
    </p>

    <p>
        <strong>Metode Pembayaran</strong><br>
        {{ $transaction->paymentMethod->method_name ?? '-' }}
    </p>
</div>

<hr>

{{-- ================= TABEL DETAIL PRODUK ================= --}}
<h3 style="margin-bottom:15px;">Detail Produk</h3>

<table width="100%" cellpadding="10" cellspacing="0"
       style="border-collapse: collapse; border-radius:12px; overflow:hidden;">
    <thead>
        <tr style="background:#f3f4f6;">
            <th align="left">Produk</th>
            <th align="center">Jumlah</th>
            <th align="right">Harga Satuan</th>
            <th align="right">Sub Total</th>
        </tr>
    </thead>

    <tbody>
        @php $grandTotal = 0; @endphp

        @forelse ($transaction->details as $detail)
            @php
                $price = $detail->product->price ?? 0;
                $qty = $detail->items_amount;
                $subTotal = $price * $qty;
                $grandTotal += $subTotal;
            @endphp

            <tr style="border-bottom:1px solid #e5e7eb;">
                <td>{{ $detail->product->title ?? '-' }}</td>
                <td align="center">{{ $qty }}</td>
                <td align="right">
                    Rp {{ number_format($price, 0, ',', '.') }}
                </td>
                <td align="right">
                    Rp {{ number_format($subTotal, 0, ',', '.') }}
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4" align="center">Tidak ada produk</td>
            </tr>
        @endforelse
    </tbody>

    <tfoot>
        <tr style="background:#e5e7eb;font-weight:bold;">
            <td colspan="3" align="right">Grand Total</td>
            <td align="right">
                Rp {{ number_format($grandTotal, 0, ',', '.') }}
            </td>
        </tr>
    </tfoot>
</table>

{{-- ================= ACTION ================= --}}
<div class="form-actions" style="margin-top:30px;">
    <a href="{{ route('admin.transactions.index') }}" class="btn-danger">
        &lt; Kembali
    </a>
</div>

@endsection