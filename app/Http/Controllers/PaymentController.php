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
use App\Models\Cart;

class PaymentController extends Controller
{
    /**
     * PAYMENT PAGE
     */
    public function index(Request $request)
    {
        $paymentMethod = Pmethod::findOrFail($request->id_method);

        return view('payment.index', [
            'total' => $request->total,
            'paymentMethod' => $paymentMethod,
            'product_id' => $request->product_id,
            'qty' => $request->qty,
            'type' => $request->type,          // 🔥 PENTING
            'cart_ids' => $request->cart_ids   // 🔥 PENTING
        ]);
    }

    /**
     * PROCESS PAYMENT
     */
    public function process(Request $request)
    {
        $request->validate([
            'payment_proof' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'id_method' => 'required',
            'type' => 'required|in:instant,cart'
        ]);

        DB::beginTransaction();

        try {
            // 1️⃣ SIMPAN BUKTI PEMBAYARAN
            $paymentProofPath = $request->file('payment_proof')
                ->store('payment_proofs', 'public');

            // 2️⃣ BUAT TRANSAKSI
            $transaction = Transaction::create([
                'id_user' => Auth::id(),
                'id_method' => $request->id_method,
                'transaction_time' => now(),
                'id_payment_status' => 1, // menunggu konfirmasi
                'id_order_status' => 1
            ]);

            /**
             * ===============================
             * INSTANT CHECKOUT
             * ===============================
             */
            if ($request->type === 'instant') {

                $request->validate([
                    'product_id' => 'required|exists:products,id',
                    'qty' => 'required|integer|min:1'
                ]);

                $product = Product::lockForUpdate()
                    ->findOrFail($request->product_id);

                if ($product->stock < $request->qty) {
                    throw new \Exception(
                        'Stock tidak mencukupi. Stock tersedia: ' . $product->stock
                    );
                }

                $product->decrement('stock', $request->qty);

                DetailTransaction::create([
                    'transaction_id' => $transaction->id_transaction,
                    'product_id' => $product->id,
                    'items_amount' => $request->qty,
                    'total_price' => $product->price * $request->qty
                ]);
            }

            /**
             * ===============================
             * CART CHECKOUT
             * ===============================
             */
            if ($request->type === 'cart') {

                if (!$request->cart_ids || !is_array($request->cart_ids)) {
                    throw new \Exception('Data cart tidak valid');
                }

                foreach ($request->cart_ids as $cartId) {

                    $cart = Cart::with('product')
                        ->where('id_cart', $cartId)
                        ->where('id_user', Auth::id())
                        ->lockForUpdate()
                        ->firstOrFail();

                    if ($cart->product->stock < $cart->quantity) {
                        throw new \Exception(
                            'Stock ' . $cart->product->title . ' tidak mencukupi'
                        );
                    }

                    // Kurangi stok
                    $cart->product->decrement('stock', $cart->quantity);

                    // Simpan detail transaksi
                    DetailTransaction::create([
                        'transaction_id' => $transaction->id_transaction,
                        'product_id' => $cart->product->id,
                        'items_amount' => $cart->quantity,
                        'total_price' => $cart->product->price * $cart->quantity
                    ]);

                    // Hapus cart
                    $cart->delete();
                }
            }

            DB::commit();

            // 🔔 EMAIL
            $transaction->load([
                'details.product',
                'paymentMethod',
                'paymentStatus',
                'user'
            ]);

            Mail::to(Auth::user()->email)
                ->send(new TransactionSuccessMail($transaction));

            // 🔁 REDIRECT KE HISTORI TRANSAKSI
            return redirect()
    ->route('transactions.show', $transaction->id_transaction)
    ->with('success', 'Pembayaran berhasil');

        } catch (\Exception $e) {
            DB::rollBack();

            return back()->withErrors([
                'error' => 'Transaksi gagal: ' . $e->getMessage()
            ]);
        }
    }
}
