<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('carts', function (Blueprint $table) {

            // kolom jumlah barang
            $table->unsignedInteger('quantity')
                ->default(1)
                ->after('product_id');

            // biar 1 user tidak punya produk sama lebih dari 1 baris
            $table->unique(['id_user', 'product_id']);
        });
    }

    public function down(): void
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->dropUnique(['id_user', 'product_id']);
            $table->dropColumn('quantity');
        });
    }
};
