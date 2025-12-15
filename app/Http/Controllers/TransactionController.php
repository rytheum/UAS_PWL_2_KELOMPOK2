<?php

namespace App\Http\Controllers;


use App\Models\Transaction;
use App\Models\DetailTransaction;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Transaction::with('details')->get();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.transactions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         DB::transaction(function () use ($request) {
            // 1. Buat transaksi
            $transaction = Transaction::create([
                'id_user' => $request->id_user,
                'id_method' => $request->id_method,
                'transaction_time' => now(),
                'id_cart' => null,
                'id_payment_status' => 1, // pending
                'id_order_status' => 1    // diproses
            ]);

            // 2. Ambil cart user
            $carts = Cart::where('id_user', $request->id_user)->get();

            // 3. Pindahkan cart ke detail_transaksi
            foreach ($carts as $cart) {
                DetailTransaction::create([
                    'id_transaction' => $transaction->id_transaction,
                    'id_product' => $cart->id_product,
                    'items_amount' => $cart->jumlah_produk,
                    'total_price' => $cart->jumlah_produk * 10000 // contoh harga
                ]);
            }
            // 4. Kosongkan cart
            Cart::where('id_user', $request->id_user)->delete();
        });

        return response()->json([
            'message' => 'Transaksi berhasil dibuat'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Transaction::with('details')
            ->where('id_transaction', $id)
            ->firstOrFail();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return Transaction::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $transaction = Transaction::findOrFail($id);

        $transaction->update([
            'id_payment_status' => $request->id_payment_status,
            'id_order_status' => $request->id_order_status
        ]);

        return response()->json([
            'message' => 'Status transaksi berhasil diperbarui'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Transaction::where('id_transaction', $id)->delete();

        return response()->json([
            'message' => 'Transaksi berhasil dihapus'
        ]);
    }
}
