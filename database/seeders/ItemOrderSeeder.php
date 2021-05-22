<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 4; $i++) {
            DB::table('item_order')->insert([
                'item_id' => rand(1, 3),
                'order_id' => rand(1, 5),
                'amount' => rand(1,4),
            ]);
        }
    }
}
