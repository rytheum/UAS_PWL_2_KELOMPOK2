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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id('id_transaction');

            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_method');
            $table->unsignedBigInteger('id_cart');
            $table->unsignedBigInteger('id_payment_status');
            $table->unsignedBigInteger('id_order_status');

            $table->timestamp('transaction_time');

            $table->foreign('id_user')->references('id_user')->on('users')->cascadeOnDelete();
            $table->foreign('id_method')->references('id_method')->on('payment_methods');
            $table->foreign('id_cart')->references('id_cart')->on('carts');
            $table->foreign('id_payment_status')->references('id_payment_status')->on('payment_statuses');
            $table->foreign('id_order_status')->references('id_order_status')->on('order_statuses');

            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
