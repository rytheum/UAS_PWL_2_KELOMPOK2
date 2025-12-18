@extends('layouts.app')

@section('content')
<div class="container" style="margin-top:40px;max-width:900px;">

    <a href="{{ route('transactions.index') }}"
       style="text-decoration:none;color:#e74c3c;">
        ← Kembali ke Histori
    </a>

    <h2 style="margin:20px 0;">Detail Transaksi</h2>

    {{-- INFO TRANSAKSI --}}
    <div style="background:#f9fafb;padding:20px;border-radius:10px;margin-bottom:25px;">
        <p><strong>ID Transaksi:</strong> {{ $transaction->id_transaction }}</p>
        <p><strong>Tanggal:</strong>
            {{ \Carbon\Carbon::parse($transaction->transaction_time)->format('d M Y') }}
        </p>
        <p><strong>Status Pembayaran:</strong>
            {{ $transaction->paymentStatus->status_name ?? '-' }}
        </p>
        <p><strong>Metode Pembayaran:</strong>
            {{ $transaction->paymentMethod->method_name ?? '-' }}
        </p>
    </div>

    {{-- TABEL PRODUK --}}
    <table width="100%" cellpadding="12" cellspacing="0"
           style="border-collapse:collapse;background:#fff;">
        <thead style="background:#f3f4f6;">
            <tr>
                <th align="left">Produk</th>
                <th align="center">Jumlah</th>
                <th align="right">Harga</th>
                <th align="right">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @php $grandTotal = 0; @endphp

            @foreach ($transaction->details as $detail)
                @php
                    $price = $detail->product->price ?? 0;
                    $qty = $detail->items_amount;
                    $sub = $price * $qty;
                    $grandTotal += $sub;
                @endphp
                <tr style="border-bottom:1px solid #e5e7eb;">
                    <td>{{ $detail->product->title ?? '-' }}</td>
                    <td align="center">{{ $qty }}</td>
                    <td align="right">
                        Rp {{ number_format($price,0,',','.') }}
                    </td>
                    <td align="right">
                        Rp {{ number_format($sub,0,',','.') }}
                    </td>
                </tr>
            @endforeach
        </tbody>

        <tfoot>
            <tr style="background:#e5e7eb;font-weight:bold;">
                <td colspan="3" align="right">Total</td>
                <td align="right">
                    Rp {{ number_format($grandTotal,0,',','.') }}
                </td>
            </tr>
        </tfoot>
    </table>

</div>
@endsection
