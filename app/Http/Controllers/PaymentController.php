<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pmethod; // ⬅️ TAMBAH INI

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        // 🔥 ambil payment method dari checkout
        $paymentMethod = Pmethod::findOrFail($request->id_method);

        return view('payment.index', [
            'total' => $request->total ?? 0,
            'paymentMethod' => $paymentMethod, // ⬅️ KIRIM KE VIEW
        ]);
    }

    public function process(Request $request)
    {
        $request->validate([
            'payment_proof' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        // sementara cuma redirect
        return redirect()->route('landing')
            ->with('success', 'Payment uploaded successfully!');
    }
}
