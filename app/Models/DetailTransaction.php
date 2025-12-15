<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class DetailTransaction extends Model
{
protected $table = 'detail_transactions';
protected $primaryKey = 'id_detail';
protected $fillable = [
'id_transaction','id_product','items_amount','total_price'
];
}
