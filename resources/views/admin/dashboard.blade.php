@extends('layouts.main')

@section('title', 'Admin Dashboard')
@section('page-title', 'DASHBOARD')

@section('content')

  {{-- CARDS --}}
  <section class="cards">
    <div class="card">
      <small>Categories</small>
      <h2>{{ $totalCategories }} Cat</h2>
      <a href="{{ route('admin.categories.index') }}">Kelola Categories</a>
    </div>

    <div class="card">
      <small>Product</small>
      <h2>{{ $totalProducts }} Pcs</h2>
      <a href="{{ route('admin.products.index') }}">Kelola Product</a>
    </div>

    <div class="card">
      <small>Transaction</small>
      <h2>{{ $totalTransactions }}  Trx</h2>
      <a href="{{ route('admin.transactions.index') }}">Kelola Transaction</a>
    </div>

    <div class="card">
      <small>Admin</small>
      <h2>{{  $totalUsers }} Usr</h2>
      <a href="{{ route('admin.user.index') }}">Kelola User</a>
    </div>
  </section>

  {{-- BOTTOM --}}
<section class="bottom" style="display: flex; gap: 20px; margin-top: 20px;">
    {{-- Tabel Kategori & Jumlah Produk --}}
    <div class="box" style="flex: 1; background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
        <h3 style="margin-bottom: 15px;">Ringkasan Produk per Kategori</h3>
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="border-bottom: 2px solid #eee; text-align: left;">
                    <th style="padding: 10px;">Nama Kategori</th>
                    <th style="padding: 10px; text-align: center;">Jumlah Produk</th>
                </tr>
            </thead>
            <tbody>
                @forelse($chartLabels as $index => $label)
                <tr style="border-bottom: 1px solid #eee;">
                    <td style="padding: 10px;">{{ $label }}</td>
                    <td style="padding: 10px; text-align: center;">
                        <span style="background: #eef2ff; color: #4e73df; padding: 2px 10px; border-radius: 10px; font-weight: bold;">
                            {{ $chartData[$index] }}
                        </span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="2" style="padding: 20px; text-align: center; color: #888;">Belum ada data kategori.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Info Tambahan (Misal: Riwayat Singkat atau Status) --}}
    <div class="box" style="flex: 1; background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
        <h3 style="margin-bottom: 15px;">Status Sistem</h3>
        <ul style="list-style: none; padding: 0;">
            <li style="display: flex; justify-content: space-between; padding: 10px 0; border-bottom: 1px solid #eee;">
                <span>Total Pengguna</span>
                <strong>{{ $totalUsers }} Orang</strong>
            </li>
            <li style="display: flex; justify-content: space-between; padding: 10px 0; border-bottom: 1px solid #eee;">
                <span>Total Transaksi</span>
                <strong>{{ $totalTransactions }} Trx</strong>
            </li>
            <li style="display: flex; justify-content: space-between; padding: 10px 0; border-bottom: 1px solid #eee;">
                <span>Rata-rata Produk/Kat</span>
                <strong>
                    {{ $totalCategories > 0 ? number_format($totalProducts / $totalCategories, 1) : 0 }}
                </strong>
            </li>
        </ul>
        <div style="margin-top: 20px; text-align: center;">
            <p style="font-size: 0.9em; color: #666;">Data diperbarui pada: {{ date('d M Y H:i') }}</p>
        </div>
    </div>
</section>
@endsection