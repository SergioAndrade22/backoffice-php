<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0; $i < 5; $i++) {
            Order::create(
                array(
                    'table_id' => rand(1, 9),
                    'total_cost' => rand(900, 2900),
                )
            );
        }
    }
}
