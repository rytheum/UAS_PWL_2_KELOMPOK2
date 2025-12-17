<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Pmethod;
use App\Models\Transaction;
use App\Models\DetailTransaction;
use App\Models\Product;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $paymentMethod = Pmethod::findOrFail($request->id_method);

        return view('payment.index', [
            'total' => $request->total,
            'paymentMethod' => $paymentMethod,

            // 🔥 TERUSKAN DATA PRODUK
            'product_id' => $request->product_id,
            'qty' => $request->qty,
        ]);
    }

    public function process(Request $request)
    {
        $request->validate([
            'payment_proof' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'id_method' => 'required',
            'product_id' => 'required|exists:products,id',
            'qty' => 'required|integer|min:1'
        ]);

        // 1️⃣ simpan bukti pembayaran
        $request->file('payment_proof')
                ->store('payment_proofs', 'public');

        // 2️⃣ ambil produk dari DB (AMAN)
        $product = Product::findOrFail($request->product_id);

        // 3️⃣ simpan transaksi (HEADER)
        $transaction = Transaction::create([
            'id_user' => Auth::id(),
            'id_method' => $request->id_method,
            'transaction_time' => now(),
            'id_payment_status' => 1, // Menunggu
            'id_order_status' => 1    // Pending
        ]);

        // 4️⃣ simpan detail transaksi (ISI PRODUK)
        DetailTransaction::create([
            'transaction_id' => $transaction->id_transaction,
            'product_id' => $product->id,
            'items_amount' => $request->qty,
            'total_price' => $product->price * $request->qty
        ]);

        // 5️⃣ redirect ke detail transaksi
        return redirect()
            ->route('transaction.detail', $transaction->id_transaction);
    }
}
