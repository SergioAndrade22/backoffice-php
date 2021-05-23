<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    protected $fillable = [
        'people',
        'description',
    ];

    public function orders() {
        return $this->hasMany(Order::class);
    }
}
