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
  <section class="bottom">
    <div class="box">
      <h3>Statistik Produk</h3>
      <canvas id="productChart"></canvas> 
    </div>
    <div class="box">
      <h3>Laporan Keuangan</h3>
      <canvas id="financeChart"></canvas>
    </div>
  </section>

@endsection