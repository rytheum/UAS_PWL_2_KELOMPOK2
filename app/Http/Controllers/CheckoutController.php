<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Pmethod;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        $qty = $request->qty;
        $subtotal = $product->price * $qty;

        // 🔥 VALIDASI STOCK: Cek apakah stock mencukupi
        if ($product->stock < $qty) {
            return back()->withErrors([
                'stock' => 'Stock tidak mencukupi. Stock tersedia: ' . $product->stock
            ]);
        }

        // 🔥 ambil payment method dari DB
        $paymentMethods = Pmethod::all();

        return view('checkout.index', compact(
            'product',
            'qty',
            'subtotal',
            'paymentMethods'
        ))->with('userAddress', auth()->user()->address ?? '');
    }
}