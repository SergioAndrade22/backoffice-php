<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    public const ROLES = [
        1 => 'waiter',
        2 => 'cashier',
        3 => 'manager',
    ];
    
    protected $fillable = [
        'first_name',
        'last_name',
    ];

    public static function getRoleID($role) {
        return array_search($role, self::ROLES);
    }

    public function getRoleAttribute() {
        return self::ROLES[ $this->attributes['employee_role_id'] ];
    }

    public function setRoleAttribute($value) {
        $roleID = self::getRoleID($value);
        if ($roleID) {
            $this->attributes['employee_role_id'] = $roleID;
        }
    }

    public function username() {
        return $this->belongsTo(User::class);
    }
}
