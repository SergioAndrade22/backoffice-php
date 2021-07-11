<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'name',
        'cuisine',
        'is_vege',
        'is_vegan',
        'is_coeliac',
        'has_alcohol',
        'cost',
        'picture',
    ];

    public function orders() {
        return $this->belongsToMany(Order::class)->withPivot('order_id', 'amount');
    }
}
