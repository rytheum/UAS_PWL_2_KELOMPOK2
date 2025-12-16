<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pstatus extends Model
{
    use HasFactory;

    protected $table = 'payment_statuses';
    protected $primaryKey = 'id_payment_status';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'status_name',
    ];
}
