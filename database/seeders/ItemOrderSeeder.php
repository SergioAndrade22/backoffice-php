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
        $items_id = [1,2,3];
        $orders_id = [1,2,3,4,5];
        for ($i = 0; $i < 4; $i++) {
            DB::table('item_order')->insert([
                'item_id' => $items_id[$i],
                'order_id' => $orders_id[$i],
                'amount' => rand(1,4),
            ]);
        }
    }
}
