<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class Cart extends Model
{
protected $table = 'carts';
protected $primaryKey = 'id_cart';
protected $fillable = [
'id_user','product_id','quantity'
];
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}