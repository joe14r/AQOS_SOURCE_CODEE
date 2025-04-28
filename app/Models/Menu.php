<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menu_items';

    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
        'status',
    ];

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItems::class, 'menu_item_id');
    }
}
