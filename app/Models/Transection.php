<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transection extends Model
{
    use HasFactory;

    protected $table = 'transection';

    protected $fillable = [
        'payment_method',
        'date_time',
        'table_no',
        'recipeta_number',
        'amount'
    ];

    protected $dates = ['date_time'];

}
