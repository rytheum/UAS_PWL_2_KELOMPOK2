<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class Transaction extends Model
{
protected $table = 'transactions';
protected $primaryKey = 'id_transaction';
protected $fillable = [
'id_user','id_method','transaction_time','id_cart','id_payment_status','id_order_status'
];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function details()
{
return $this->hasMany(DetailTransaction::class, 'id_transaction');
}
}
