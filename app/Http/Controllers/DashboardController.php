<?php

namespace App\Http\Controllers;

// Import semua model yang dibutuhkan
use App\Models\User;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Pastikan hanya admin yang bisa masuk
        abort_if(auth()->user()->role !== 'admin', 403);

        // Hitung jumlah data
        $totalCategories = ProductCategory::count();
        $totalProducts = Product::count();
        $totalTransactions = Transaction::count();
        $totalUsers = User::count();

        // Kirim data ke view menggunakan compact()
        return view('admin.dashboard', compact(
            'totalCategories', 
            'totalProducts', 
            'totalTransactions', 
            'totalUsers',
        ));
    }
}