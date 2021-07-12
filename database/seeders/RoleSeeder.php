<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Role::create(['name'=>'admin']);
        $waiter = Role::create(['name'=>'waiter']);
        $cashier = Role::create(['name'=>'cashier']);
        $manager = Role::create(['name'=>'manager']);

        Permission::create(['name'=>'employees.index'])->syncRoles([$admin, $manager]);
        Permission::create(['name'=>'employees.show'])->syncRoles([$admin, $manager]);
        Permission::create(['name'=>'employees.create'])->syncRoles([$admin, $manager]);
        Permission::create(['name'=>'employees.edit'])->syncRoles([$admin, $manager]);
        Permission::create(['name'=>'employees.destroy'])->syncRoles([$admin]);

        Permission::create(['name'=>'items.index'])->syncRoles([$admin, $manager, $cashier, $waiter]);
        Permission::create(['name'=>'items.show'])->syncRoles([$admin, $manager, $cashier, $waiter]);
        Permission::create(['name'=>'items.create'])->syncRoles([$admin, $manager]);
        Permission::create(['name'=>'items.edit'])->syncRoles([$admin, $manager]);
        Permission::create(['name'=>'items.destroy'])->syncRoles([$admin, $manager]);

        Permission::create(['name'=>'orders.index'])->syncRoles([$admin, $manager, $cashier, $waiter]);
        Permission::create(['name'=>'orders.show'])->syncRoles([$admin, $manager, $cashier, $waiter]);
        Permission::create(['name'=>'orders.create'])->syncRoles([$admin, $manager, $cashier]);
        Permission::create(['name'=>'orders.edit'])->syncRoles([$admin, $manager, $cashier]);
        Permission::create(['name'=>'orders.destroy'])->syncRoles([$admin, $manager]);

        Permission::create(['name'=>'tables.index'])->syncRoles([$admin, $manager, $cashier, $waiter]);
        Permission::create(['name'=>'tables.show'])->syncRoles([$admin, $manager, $cashier, $waiter]);
        Permission::create(['name'=>'tables.create'])->syncRoles([$admin, $manager]);
        Permission::create(['name'=>'tables.edit'])->syncRoles([$admin, $manager]);
        Permission::create(['name'=>'tables.destroy'])->syncRoles([$admin, $manager]);
    }
}
