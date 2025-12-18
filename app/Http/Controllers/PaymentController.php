<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\TransactionSuccessMail;
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

        // 1️⃣ Simpan bukti pembayaran
        $request->file('payment_proof')
                ->store('payment_proofs', 'public');

        // 2️⃣ Ambil produk
        $product = Product::findOrFail($request->product_id);

        // 3️⃣ Simpan transaksi
        $transaction = Transaction::create([
            'id_user' => Auth::id(),
            'id_method' => $request->id_method,
            'transaction_time' => now(),
            'id_payment_status' => 1,
            'id_order_status' => 1
        ]);

        // 4️⃣ Simpan detail transaksi
        DetailTransaction::create([
            'transaction_id' => $transaction->id_transaction,
            'product_id' => $product->id,
            'items_amount' => $request->qty,
            'total_price' => $product->price * $request->qty
        ]);

        $transaction->load([
            'details.product',
            'paymentMethod',
            'paymentStatus',
            'user'
        ]);

        // 🔔 5️⃣ KIRIM EMAIL NOTIFIKASI
        Mail::to(Auth::user()->email)
            ->send(new TransactionSuccessMail($transaction));

        // 6️⃣ Redirect ke detail transaksi (customer)
        return redirect()
            ->route('transactions.show', $transaction->id_transaction);
    }
}
