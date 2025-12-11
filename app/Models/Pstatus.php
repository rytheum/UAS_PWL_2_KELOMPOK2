<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
<<<<<<< HEAD

class Pstatus extends Model
{
    //
=======
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pstatus extends Model
{
    use HasFactory;

    protected $table = 'payment_statuses';

    protected $fillable = [
        'status_name',
    ];
>>>>>>> fa9572eb44d4f887aabafd0fa2dd175a087094ef
}
