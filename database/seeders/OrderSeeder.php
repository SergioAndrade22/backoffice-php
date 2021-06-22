<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use Carbon\Carbon;

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
                    'total_cost' => rand(900, 2900),
                    'date' => Carbon::now()->subDays(rand(1,95)),
                )
            );
        }
    }
}
