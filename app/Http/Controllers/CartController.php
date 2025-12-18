<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Pmethod;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Tampilkan cart
     */
    public function index()
    {
        $carts = auth()->check()
            ? Cart::with('product')
                ->where('id_user', auth()->id())
                ->get()
            : collect();

        return view('cart.index', compact('carts'));
    }

    /**
     * Add product ke cart
     */
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id'
        ]);

        $cart = Cart::where('id_user', auth()->id())
            ->where('product_id', $request->product_id)
            ->first();

        if ($cart) {
            // produk sudah ada → tambah qty
            $cart->increment('quantity');
        } else {
            // produk belum ada
            Cart::create([
                'id_user' => auth()->id(),
                'product_id' => $request->product_id,
                'quantity' => 1
            ]);
        }

        return redirect()->route('cart');
    }

    /**
     * Update quantity (+ / -)
     */
    public function update(Request $request, $id_cart)
    {
        $request->validate([
            'action' => 'required|in:increase,decrease'
        ]);

        $cart = Cart::where('id_cart', $id_cart)
            ->where('id_user', auth()->id())
            ->firstOrFail();

        if ($request->action === 'increase') {
            $cart->increment('quantity');
        }

        if ($request->action === 'decrease') {
            if ($cart->quantity > 1) {
                $cart->decrement('quantity');
            }
        }

        return redirect()->back();
    }

    /**
     * Hapus item cart
     */
    public function destroy($id_cart)
    {
        Cart::where('id_cart', $id_cart)
            ->where('id_user', auth()->id())
            ->delete();

        return redirect()->back();
    }

    /**
     * Redirect ke checkout (MULTI PRODUCT)
     */

    public function checkout()
    {
        $cartItems = Cart::with('product')
            ->where('id_user', auth()->id())
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart')->with('error', 'Cart masih kosong');
        }

        $totalQty = $cartItems->sum('quantity');
        $totalPrice = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        $paymentMethods = Pmethod::all();

        return view('checkout.index', compact(
            'cartItems',
            'totalQty',
            'totalPrice',
            'paymentMethods'
        ));
    }
}