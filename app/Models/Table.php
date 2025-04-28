<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    protected $table = 'restaurent_table';

    protected $fillable = [
        'tid',
        'title',
        'description',
        'image',
        'status',
    ];

    public function order(): HasMany
    {
        return $this->hasMany(Order::class, 'table_id');
    }
}
