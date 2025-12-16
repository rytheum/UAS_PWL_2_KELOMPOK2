@extends('layouts.main')

@section('title', 'Tambah Category')
@section('page-title', 'Tambah Category')

@section('content')

<div style="
    background:#6676e4;
    min-height:calc(100vh - 120px);
    display:flex;
    align-items:center;
    justify-content:center;
">

    <div style="
        background:white;
        padding:30px;
        border-radius:20px;
        width:600px;
    ">

        <h2 style="margin-bottom:20px;text-align:center;">
            Tambah Category
        </h2>

        <form action="{{ route('admin.categories.store') }}" method="POST">
            @csrf

            <div style="margin-bottom:20px;">
                <label style="display:block;margin-bottom:8px;font-weight:600;">
                    Category
                </label>
               <input type="text"
                    name="category_name"
                    placeholder="Nama Category"
                    required
                       style="
                            width:100%;
                            padding:12px;
                            border-radius:8px;
                            border:1px solid #ccc;
                       ">
            </div>

            <div style="text-align:right;">
                <button type="submit"
                    style="
                        background:#28a745;
                        color:white;
                        padding:10px 18px;
                        border:none;
                        border-radius:8px;
                        cursor:pointer;
                    ">
                    Tambah +
                </button>
            </div>
        </form>

    </div>

</div>

@endsection
