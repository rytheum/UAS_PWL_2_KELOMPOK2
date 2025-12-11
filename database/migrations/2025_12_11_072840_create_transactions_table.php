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

            $table->foreignId('id_user')
                ->constrained('users', 'id_user')
                ->cascadeOnDelete();

            $table->foreignId('id_method')
                ->constrained('payment_methods', 'id_method')
                ->cascadeOnDelete();

            $table->foreignId('id_cart')
                ->constrained('carts', 'id_cart')
                ->cascadeOnDelete();

            $table->foreignId('id_payment_status')
                ->constrained('payment_statuses', 'id_payment_status')
                ->cascadeOnDelete();

            $table->foreignId('id_order_status')
                ->constrained('order_statuses', 'id_order_status')
                ->cascadeOnDelete();

            $table->timestamp('transaction_time');

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
