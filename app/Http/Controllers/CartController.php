<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    /**
     * LIHAT CART USER
     */
    public function index($id_user)
    {
        return Cart::where('id_user', $id_user)->get();
    }

    /**
     * TAMBAH PRODUK KE CART
     */
    public function store(Request $request)
    {
        Cart::updateOrCreate(
            [
                'id_user' => $request->id_user,
                'id_product' => $request->id_product
            ],
            [
                'jumlah_produk' => DB::raw('jumlah_produk + 1')
            ]
        );

        return response()->json([
            'message' => 'Produk berhasil ditambahkan ke cart'
        ]);
    }

    /**
     * UPDATE JUMLAH PRODUK
     */
    public function update(Request $request, $id)
    {
        Cart::where('id_cart', $id)
            ->update([
                'jumlah_produk' => $request->jumlah_produk
            ]);

        return response()->json([
            'message' => 'Jumlah produk berhasil diubah'
        ]);
    }

    /**
     * HAPUS ITEM CART
     */
    public function destroy($id)
    {
        Cart::where('id_cart', $id)->delete();

        return response()->json([
            'message' => 'Item cart berhasil dihapus'
        ]);
    }
}