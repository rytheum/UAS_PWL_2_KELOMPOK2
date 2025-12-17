<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    /**
     * Histori transaksi customer
     */
    public function index()
    {
        $transactions = Transaction::with([
                'paymentMethod',
                'paymentStatus'
            ])
            ->where('id_user', Auth::id())
            ->latest('transaction_time')
            ->get();

        return view('transactions.index', compact('transactions'));
    }

    /**
     * Detail transaksi customer
     */
    public function show($id)
    {
        $transaction = Transaction::with([
                'details.product',
                'paymentMethod',
                'paymentStatus'
            ])
            ->where('id_transaction', $id)
            ->where('id_user', Auth::id()) // 🔥 KEAMANAN
            ->firstOrFail();

        return view('transactions.show', compact('transaction'));
    }
}
