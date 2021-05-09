<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'total_cost',
    ];

    public function table() {
        return $this->belongsTo(Table::class);
    }

    public function items() {
        return $this->belongsToMany(Item::class);
    }
}
