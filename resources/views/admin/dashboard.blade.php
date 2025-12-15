@extends('layouts.main')

@section('title', 'Admin Dashboard')
@section('page-title', 'DASHBOARD')

@section('content')

  {{-- CARDS --}}
  <section class="cards">
    <div class="card">
      <small>Categories</small>
      <h2>3 Cat</h2>
      <a href="{{ route('admin.categories.index') }}">Kelola Categories</a>
    </div>

    <div class="card">
      <small>Product</small>
      <h2>4 Item</h2>
      <a href="#">Kelola Product</a>
    </div>

    <div class="card">
      <small>Transaction</small>
      <h2>5 Trx</h2>
      <a href="{{ route('admin.transactions.index') }}">Kelola Transaction</a>
    </div>

    <div class="card">
      <small>Admin</small>
      <h2>5 People</h2>
      <a href="{{ route('admin.user.index') }}">Kelola User</a>
    </div>
  </section>

  {{-- BOTTOM --}}
  <section class="bottom">
    <div class="box">
      <img src="/images/products.png" alt="Products">
    </div>
    <div class="box">
      <img src="/images/finance.png" alt="Finance">
    </div>
  </section>

@endsection