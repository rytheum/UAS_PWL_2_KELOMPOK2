@extends('layouts.app')

@section('content')

<style>
    body {
        background-color: #f9fafb;
        font-family: Arial, sans-serif;
    }

    .trx-container {
        max-width: 900px;
        margin: 40px auto;
        background: #ffffff;
        padding: 24px;
        border-radius: 10px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.05);
    }

    .trx-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .trx-header h2 {
        margin: 0;
        font-size: 22px;
    }

    .btn-back {
        text-decoration: none;
        padding: 8px 14px;
        background: #e5e7eb;
        color: #111827;
        border-radius: 6px;
        font-size: 14px;
        transition: 0.2s;
    }

    .btn-back:hover {
        background: #d1d5db;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        font-size: 14px;
    }

    thead {
        background: #f3f4f6;
    }

    th, td {
        padding: 12px;
        text-align: left;
    }

    tbody tr {
        border-bottom: 1px solid #e5e7eb;
    }

    tbody tr:hover {
        background: #f9fafb;
    }

    .trx-status {
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 12px;
        background: #e0f2fe;
        color: #0369a1;
        display: inline-block;
    }

    .btn-detail {
        text-decoration: none;
        color: #2563eb;
        font-weight: bold;
    }

    .btn-detail:hover {
        text-decoration: underline;
    }

    .empty-text {
        text-align: center;
        color: #6b7280;
        margin-top: 30px;
    }
</style>

<div class="trx-container">

    <div class="trx-header">
        <h2>🧾 Histori Transaksi</h2>
        <a href="{{ route('landing') }}" class="btn-back">← Kembali</a>
    </div>

    @if ($transactions->isEmpty())
        <p class="empty-text">Belum ada transaksi.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tanggal</th>
                    <th>Metode</th>
                    <th>Status</th>
                    <th style="text-align:right;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transactions as $trx)
                    <tr>
                        <td>#{{ $trx->id_transaction }}</td>
                        <td>
                            {{ \Carbon\Carbon::parse($trx->transaction_time)->format('d M Y') }}
                        </td>
                        <td>{{ $trx->paymentMethod->method_name ?? '-' }}</td>
                        <td>
                            <span class="trx-status">
                                {{ $trx->paymentStatus->status_name ?? '-' }}
                            </span>
                        </td>
                        <td style="text-align:right;">
                            <a class="btn-detail"
                               href="{{ route('transactions.show', $trx->id_transaction) }}">
                                Detail →
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

</div>

@endsection
