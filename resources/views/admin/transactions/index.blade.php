@extends('layouts.main')

@section('title', 'Data Transaksi')
@section('page-title', 'DATA TRANSAKSI')

@section('content')

    <div style="
        background:#fff;
        border-radius:18px;
        padding:25px;
        box-shadow:0 10px 30px rgba(0,0,0,.08);
    ">

        <table width="100%" cellspacing="0" cellpadding="12">
            <thead>
                <tr style="background:#f1f1f1;font-size:14px;color:#555;">
                    <th width="50">No</th>
                    <th>ID Transaksi</th>
                    <th>Email Pembeli</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th width="160">Action</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($transactions as $index => $transaction)
                    <tr style="border-bottom:1px solid #ddd;">
                        <td>{{ $index + 1 }}</td>

                        <td>
                            <strong>TRX-{{ str_pad($transaction->id_transaction, 3, '0', STR_PAD_LEFT) }}</strong>
                        </td>

                        <td>
                            {{ $transaction->user->email ?? 'unknown@email.com' }}
                        </td>

                        <td>
                            {{ \Carbon\Carbon::parse($transaction->transaction_time)->format('d/m/Y') }}
                        </td>

                        <td>
                            @php
                                $statusText = match ($transaction->id_payment_status) {
                                    1 => 'Belum Dibayar',
                                    2 => 'Diproses',
                                    3 => 'Selesai',
                                    default => 'Unknown'
                                };

                                $statusColor = match ($transaction->id_payment_status) {
                                    1 => '#f1c40f',
                                    2 => '#3498db',
                                    3 => '#2ecc71',
                                    default => '#95a5a6'
                                };
                            @endphp

                            <span style="
                                    background:{{ $statusColor }};
                                    color:white;
                                    padding:6px 14px;
                                    border-radius:20px;
                                    font-size:12px;
                                ">
                                {{ $statusText }}
                            </span>
                        </td>

                        <td>
                            {{-- VIEW --}}
                            <a href="{{ route('admin.transactions.show', $transaction->id_transaction) }}" style="
                                       background:#0d6efd;
                                       color:white;
                                       padding:8px 10px;
                                       border-radius:8px;
                                       text-decoration:none;
                                       margin-right:5px;
                                   ">
                                <i class="fa fa-eye"></i>
                            </a>

                            {{-- EDIT --}}
                            <a href="{{ route('admin.transactions.edit', $transaction->id_transaction) }}" style="
                                       background:#f1c40f;
                                       color:white;
                                       padding:8px 10px;
                                       border-radius:8px;
                                       text-decoration:none;
                                       margin-right:5px;
                                   ">
                                <i class="fa fa-pen"></i>
                            </a>

                            {{-- DELETE --}}
                            <form action="{{ route('admin.transactions.destroy', $transaction->id_transaction) }}" method="POST"
                                style="display:inline" onsubmit="return confirm('Yakin hapus transaksi ini?')">
                                @csrf
                                @method('DELETE')

                                <button type="submit" style="
                                            background:#e74c3c;
                                            color:white;
                                            border:none;
                                            padding:8px 10px;
                                            border-radius:8px;
                                            cursor:pointer;
                                        ">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="text-align:center;padding:20px;color:#999;">
                            Tidak ada transaksi
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- BUTTON TAMBAH --}}
        <div style="margin-top:25px;">
            <a href="{{ route('admin.transactions.create') }}" style="
                   background:#2ecc71;
                   color:white;
                   padding:12px 20px;
                   border-radius:10px;
                   text-decoration:none;
                   font-weight:600;
               ">
                Tambah Transaction
            </a>
        </div>

    </div>

@endsection