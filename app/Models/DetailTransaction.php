<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class DetailTransaction extends Model
{
    protected $table = 'detail_transactions';

    protected $fillable = [
        'transaction_id', // 🔥 PENTING
        'product_id',
        'items_amount',
        'total_price',
    ];

    public function transaction()
    {
        return $this->belongsTo(
            Transaction::class,
            'transaction_id',
            'id_transaction'
        );
    }
}
