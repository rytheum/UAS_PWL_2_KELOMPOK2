<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pmethod extends Model
{
    use HasFactory;

    protected $table = 'payment_methods';

    protected $primaryKey = 'id_method';    
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = [
        'method_name',
    ];
}
