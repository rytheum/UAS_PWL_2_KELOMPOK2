<?php

namespace App\Http\Controllers;

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

        // 🔥 ambil payment method dari DB
        $paymentMethods = Pmethod::all();

        return view('checkout.index', compact(
            'product',
            'qty',
            'subtotal',
            'paymentMethods'
        ));
    }
}
