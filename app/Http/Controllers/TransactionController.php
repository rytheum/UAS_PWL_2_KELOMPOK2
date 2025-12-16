<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\DetailTransaction;
use App\Models\Cart;
use App\Models\Pmethod;
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
        return view('admin.transactions.create', [
        'products' => Product::all(),
        'payment_methods' => Pmethod::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'transaction_time' => 'required|date',
            'id_method' => 'required|exists:payment_methods,id_method',
            'id_payment_status' => 'required',
            'id_product' => 'required|array',
            'items_amount' => 'required|array',
        ]);

        DB::transaction(function () use ($request) {

            // 1️⃣ Simpan transaksi
            $transaction = Transaction::create([
                'id_user' => Auth::id(),
                'id_method' => 1,
                'transaction_time' => now(),
                'id_payment_status' => 1,
                'id_order_status' => 1,
            ]);

            // 2️⃣ Simpan detail transaksi
            foreach ($request->id_product as $i => $productId) {
                    $product = Product::findOrFail($productId);

                    $transaction->details()->create([
                        'product_id' => $productId,
                        'items_amount' => $request->items_amount[$i],
                        'total_price' => $product->price * $request->items_amount[$i],
                    ]);
                }

                // 3️⃣ Kurangi stok
                $product->decrement('stock', $request->items_amount[$i]);
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

    
    public function edit(string $id)
    {
        $transaction = Transaction::findOrFail($id);

        $products = Product::all();
        $payment_methods = Pmethod::all();

        return view('admin.transactions.edit ', compact('transaction','products','payment_methods'));
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
