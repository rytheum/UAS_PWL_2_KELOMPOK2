<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class Transaction extends Model
{
    protected $table = 'transactions';
    protected $primaryKey = 'id_transaction'; // 🔥 WAJIB

    protected $fillable = [
        'id_user',
        'id_method',
        'transaction_time',
        'id_payment_status',
        'id_order_status',
    ];

    public function details()
    {
        return $this->hasMany(
            DetailTransaction::class,
            'transaction_id',   // FK di detail
            'id_transaction'    // PK di transactions
        );
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}