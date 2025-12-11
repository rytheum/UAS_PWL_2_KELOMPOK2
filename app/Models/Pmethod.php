<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
<<<<<<< HEAD

class Pmethod extends Model
{
    //
=======
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pmethod extends Model
{
    use HasFactory;

    protected $table = 'payment_methods';

    protected $fillable = [
        'method_name',
    ];
>>>>>>> fa9572eb44d4f887aabafd0fa2dd175a087094ef
}
