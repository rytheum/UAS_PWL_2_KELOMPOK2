<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('detail_transactions', function (Blueprint $table) {
            $table->id('id_detail');

            $table->unsignedBigInteger('id_transaction');
            $table->unsignedBigInteger('id_product');

            $table->integer('items_amount');
            $table->decimal('total_price', 12, 2);

            $table->foreign('id_transaction')->references('id_transaction')->on('transactions')->cascadeOnDelete();
            $table->foreign('id_product')->references('id_product')->on('products')->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_transactions');
    }
};
