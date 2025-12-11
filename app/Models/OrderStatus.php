<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
<<<<<<< HEAD

class OrderStatus extends Model
{
    //
=======
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderStatus extends Model
{
    use HasFactory;

    protected $table = 'order_statuses';

    protected $fillable = [
        'order_status_name',
    ];
>>>>>>> fa9572eb44d4f887aabafd0fa2dd175a087094ef
}
