<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
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

        DB::beginTransaction();
        
        try {
            // 1️⃣ Simpan bukti pembayaran
            $paymentProofPath = $request->file('payment_proof')
                    ->store('payment_proofs', 'public');

            // 2️⃣ Ambil produk dengan LOCK untuk update (hindari race condition)
            $product = Product::lockForUpdate()->findOrFail($request->product_id);
            
            // 🔥 VALIDASI ULANG STOCK: Cek stock sebelum transaksi
            if ($product->stock < $request->qty) {
                throw new \Exception('Maaf, stock produk tidak mencukupi. Stock tersedia: ' . $product->stock);
            }

            // 3️⃣ Kurangi stock produk
            $product->decrement('stock', $request->qty);

            // 4️⃣ Simpan transaksi
            $transaction = Transaction::create([
                'id_user' => Auth::id(),
                'id_method' => $request->id_method,
                'transaction_time' => now(),
                'id_payment_status' => 1, // Menunggu konfirmasi
                'id_order_status' => 1    // Pending
            ]);

            // 5️⃣ Simpan detail transaksi
            DetailTransaction::create([
                'transaction_id' => $transaction->id_transaction,
                'product_id' => $product->id,
                'items_amount' => $request->qty,
                'total_price' => $product->price * $request->qty
            ]);

            DB::commit();

            $transaction->load([
                'details.product',
                'paymentMethod',
                'paymentStatus',
                'user'
            ]);

            // 🔔 6️⃣ KIRIM EMAIL NOTIFIKASI
            Mail::to(Auth::user()->email)
                ->send(new TransactionSuccessMail($transaction));

            // 7️⃣ Redirect ke detail transaksi (customer)
            return redirect()
                ->route('transactions.show', $transaction->id_transaction)
                ->with('success', 'Pembayaran berhasil! Stock produk telah diperbarui.');
                
        } catch (\Exception $e) {
            DB::rollBack();
            
            return back()->withErrors([
                'error' => 'Transaksi gagal: ' . $e->getMessage()
            ])->withInput();
        }
    }
}