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
        'product_id' => 'required|exists:products,id',
        'qty' => 'required|integer|min:1'
    ]);

    $cart = Cart::where('id_user', auth()->id())
        ->where('product_id', $request->product_id)
        ->first();

    if ($cart) {
        $cart->quantity += $request->qty;
        $cart->save();
    } else {
        Cart::create([
            'id_user' => auth()->id(),
            'product_id' => $request->product_id,
            'quantity' => $request->qty
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
            $cart->quantity += 1;
            $cart->save();
        }

        if ($request->action === 'decrease') {
            if ($cart->quantity > 1) {
                $cart->quantity -= 1;
                $cart->save();
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

    /**
     * Redirect ke checkout dari cart
     */
    public function checkout()
    {
        $cartItems = Cart::with('product')
            ->where('id_user', auth()->id())
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart')->with('error', 'Cart masih kosong');
        }

        $items = collect();
        foreach ($cartItems as $cart) {
            $qty = min($cart->quantity, $cart->product->stock);
            $items->push((object) [
                'product' => $cart->product,
                'quantity' => $qty,
                'subtotal' => $cart->product->price * $qty,
                'cart_id' => $cart->id_cart, // buat tracking saat proses checkout
            ]);
        }

        $totalQty = $items->sum('quantity');
        $totalPrice = $items->sum('subtotal');

        $paymentMethods = Pmethod::all();
        $userAddress = auth()->user()->address ?? '';

        return view('checkout.index', compact(
            'items',
            'totalQty',
            'totalPrice',
            'paymentMethods',
            'userAddress'
        ));
    }

}