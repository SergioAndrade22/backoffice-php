<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    public const POSITIONS = [
        1 => 'waiter',
        2 => 'cashier',
        3 => 'manager',
    ];
    
    protected $fillable = [
        'first_name',
        'last_name',
    ];

    public static function getPositionID($role) {
        return array_search($role, self::POSITIONS);
    }

    public function getPositionAttribute() {
        return self::POSITIONS[ $this->attributes['employee_position_id'] ];
    }

    public function setPositionAttribute($value) {
        $roleID = self::getRoleID($value);
        if ($roleID) {
            $this->attributes['employee_position_id'] = $roleID;
        }
    }

    public static function allPositions() {
        return self::POSITIONS;
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
