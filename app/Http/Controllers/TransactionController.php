<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\DetailTransaction;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource (ADMIN VIEW).
     */
    public function index()
    {
        $transactions = Transaction::with('details')
            ->latest('transaction_time')
            ->get();

        return view('admin.transactions.index', compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::orderBy('title', 'asc')->get();

        return view('admin.transactions.create', compact('products'));
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::transaction(function () use ($request) {

            $transaction = Transaction::create([
                'id_user' => Auth::id(),
                'id_method' => Auth::id(),
                'transaction_time' => now(),
                'id_cart' => Auth::id(),
                'id_payment_status'  => 1, // pending
                'id_order_status' => 1    // diproses
            ]);

            $carts = Cart::where('id_user', $request->id_user)->get();

            foreach ($carts as $cart) {
                DetailTransaction::create([
                    'id_transaction' => $transaction->id_transaction,
                    'id_product' => $cart->id_product,
                    'items_amount' => $cart->jumlah_produk,
                    'total_price' => $cart->jumlah_produk * 10000 // contoh harga
                ]);
            }

            Cart::where('id_user', $request->id_user)->delete();
        });

        return redirect()
            ->route('admin.transactions.index')
            ->with('success', 'Transaksi berhasil dibuat');
    }

    /**
     * Display the specified resource (optional API / detail).
     */
    public function show(string $id)
    {
        $transaction = Transaction::with('details')
            ->where('id_transaction', $id)
            ->firstOrFail();

        return view('admin.transactions.show', compact('transaction'));
    }

    /**
     * Update status transaksi.
     */
    public function update(Request $request, string $id)
    {
        $transaction = Transaction::where('id_transaction', $id)->firstOrFail();

        $transaction->update([
            'id_payment_status' => $request->id_payment_status,
            'id_order_status' => $request->id_order_status
        ]);

        return redirect()
            ->route('admin.transactions.index')
            ->with('success', 'Status transaksi berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Transaction::where('id_transaction', $id)->delete();

        return redirect()
            ->route('admin.transactions.index')
            ->with('success', 'Transaksi berhasil dihapus');
    }
}
