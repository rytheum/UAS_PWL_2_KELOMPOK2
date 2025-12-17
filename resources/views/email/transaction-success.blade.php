<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Transaksi Berhasil</title>
</head>
<body style="margin:0;padding:0;background:#f3f4f6;font-family:Arial,Helvetica,sans-serif;">

<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td align="center" style="padding:30px 15px;">

    {{-- CONTAINER --}}
    <table width="600" cellpadding="0" cellspacing="0"
           style="background:#ffffff;border-radius:12px;overflow:hidden;box-shadow:0 4px 12px rgba(0,0,0,0.08);">

        {{-- HEADER --}}
        <tr>
            <td style="background:#4CAF50;color:#ffffff;padding:20px 30px;">
                <h2 style="margin:0;">✅ Transaksi Berhasil</h2>
                <p style="margin:5px 0 0;font-size:14px;">
                    Terima kasih telah berbelanja
                </p>
            </td>
        </tr>

        {{-- INFO TRANSAKSI --}}
        <tr>
            <td style="padding:25px 30px;font-size:14px;color:#333;">
                <p><strong>ID Transaksi:</strong><br>{{ $transaction->id_transaction }}</p>
                <p><strong>Email Pembeli:</strong><br>{{ $transaction->user->email ?? '-' }}</p>
                <p><strong>Tanggal Pembelian:</strong><br>
                    {{ \Carbon\Carbon::parse($transaction->transaction_time)->format('d M Y') }}
                </p>
                <p><strong>Status Pembayaran:</strong><br>Selesai</p>
                <p><strong>Metode Pembayaran:</strong><br>
                    {{ $transaction->paymentMethod->method_name ?? '-' }}
                </p>
            </td>
        </tr>

        {{-- TABLE PRODUK --}}
        <tr>
            <td style="padding:0 30px 30px;">
                <h3 style="margin-bottom:10px;">Detail Produk</h3>

                <table width="100%" cellpadding="10" cellspacing="0"
                       style="border-collapse:collapse;font-size:14px;">
                    <thead>
                        <tr style="background:#f3f4f6;">
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
                                $subTotal = $price * $qty;
                                $grandTotal += $subTotal;
                            @endphp
                            <tr style="border-bottom:1px solid #e5e7eb;">
                                <td>{{ $detail->product->title ?? '-' }}</td>
                                <td align="center">{{ $qty }}</td>
                                <td align="right">
                                    Rp {{ number_format($price,0,',','.') }}
                                </td>
                                <td align="right">
                                    Rp {{ number_format($subTotal,0,',','.') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                    <tfoot>
                        <tr style="background:#e5e7eb;font-weight:bold;">
                            <td colspan="3" align="right">Grand Total</td>
                            <td align="right">
                                Rp {{ number_format($grandTotal,0,',','.') }}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </td>
        </tr>

        {{-- FOOTER --}}
        <tr>
            <td align="center"
                style="background:#f9fafb;padding:15px;font-size:12px;color:#777;">
                © {{ date('Y') }} {{ config('app.name') }} — All rights reserved
            </td>
        </tr>

    </table>

</td>
</tr>
</table>

</body>
</html>
