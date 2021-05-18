<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    protected $fillable = [
        'people',
        'description',
    ];

    public function personnel() {
        return $this->belongsToMany(Personnel::class);
    }

    public function orders() {
        return $this->hasMany(Order::class);
    }
}
