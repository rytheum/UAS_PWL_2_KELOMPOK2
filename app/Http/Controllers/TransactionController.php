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
        'id_payment_status' => 'required|exists:payment_statuses,id_payment_status',
        'id_product' => 'required|array',
        'id_product.*' => 'required|exists:products,id',
        'items_amount' => 'required|array',
        'items_amount.*' => 'required|integer|min:1',
    ]);

    DB::transaction(function () use ($request) {

        // 1️⃣ BUAT TRANSAKSI
        $transaction = Transaction::create([
            'id_user' => Auth::id(),
            'id_method' => $request->id_method,
            'transaction_time' => $request->transaction_time,
            'id_payment_status' => $request->id_payment_status,
            'id_order_status' => 1, // default
        ]);

        // 2️⃣ LOOP PRODUK
        foreach ($request->id_product as $i => $productId) {

            $product = Product::findOrFail($productId);
            $qty = $request->items_amount[$i];

            // ❗ VALIDASI STOK
            if ($qty > $product->stock) {
                throw new \Exception(
                    "Stok produk {$product->title} tidak mencukupi"
                );
            }

            // 3️⃣ SIMPAN DETAIL TRANSAKSI
            DetailTransaction::create([
                'transaction_id' => $transaction->id_transaction,
                'product_id' => $product->id,
                'items_amount' => $qty,
                'total_price' => $product->price * $qty,
            ]);

            // 4️⃣ KURANGI STOK
            $product->decrement('stock', $qty);
        }
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
    $transaction = Transaction::with([
        'user',
        'paymentMethod',
        'paymentStatus',
        'details.product'
    ])->where('id_transaction', $id)->firstOrFail();

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
    $request->validate([
        'transaction_time' => 'required|date',
        'id_method' => 'required|exists:payment_methods,id_method',
        'id_payment_status' => 'required|exists:payment_statuses,id_payment_status',
        'id_product' => 'required|array',
        'id_product.*' => 'required|exists:products,id',
        'items_amount' => 'required|array',
        'items_amount.*' => 'required|integer|min:1',
    ]);

    DB::transaction(function () use ($request, $id) {

        // 1️⃣ Ambil transaksi
        $transaction = Transaction::where('id_transaction', $id)->firstOrFail();

        // 2️⃣ BALIKIN STOK LAMA
        foreach ($transaction->details as $detail) {
            $detail->product->increment('stock', $detail->items_amount);
        }

        // 3️⃣ HAPUS DETAIL LAMA
        $transaction->details()->delete();

        // 4️⃣ UPDATE DATA TRANSAKSI
        $transaction->update([
            'transaction_time' => $request->transaction_time,
            'id_method' => $request->id_method,
            'id_payment_status' => $request->id_payment_status,
            'id_order_status' => $request->id_order_status ?? $transaction->id_order_status,
        ]);

        // 5️⃣ SIMPAN DETAIL BARU
        foreach ($request->id_product as $i => $productId) {

            $product = Product::findOrFail($productId);
            $qty = $request->items_amount[$i];

            // ❗ VALIDASI STOK
            if ($qty > $product->stock) {
                throw new \Exception(
                    "Stok produk {$product->title} tidak mencukupi"
                );
            }

            DetailTransaction::create([
                'transaction_id' => $transaction->id_transaction,
                'product_id' => $product->id,
                'items_amount' => $qty,
                'total_price' => $product->price * $qty,
            ]);

            // 6️⃣ KURANGI STOK
            $product->decrement('stock', $qty);
        }
    });

    return redirect()
        ->route('admin.transactions.index')
        ->with('success', 'Transaksi berhasil diperbarui');
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