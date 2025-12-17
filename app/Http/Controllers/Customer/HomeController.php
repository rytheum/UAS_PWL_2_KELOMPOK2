<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        if (auth()->check() && auth()->user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        $products = (new Product)
            ->get_product()
            ->latest()
            ->get();

        return view('landingpage.index', compact('products'));
    }
}
