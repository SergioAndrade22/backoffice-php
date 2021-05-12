<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(ItemOrderSeeder::class);
        $this->call(TableSeeder::class);
        $this->call(OrderSeeder::class);
        $this->call(PersonnelSeeder::class);
        $this->call(ItemOrderSeeder::class);
    }
}
