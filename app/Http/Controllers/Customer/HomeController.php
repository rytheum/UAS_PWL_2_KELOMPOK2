<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        if (auth()->check() && auth()->user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        $query = (new Product)->get_product();

        // 🔍 SEARCH PRODUCT
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $products = $query->latest()->get();

        return view('landingpage.index', compact('products'));
    }

    public function detail(Product $product)
    {
        return view('landingpage.detail', compact('product'));
    }
}
