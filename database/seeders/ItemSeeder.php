<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $itemName = ["Milanesa", "Papas Fritas", "Huevos"];
        foreach($itemName as &$item) {
            Item::create(
                array(
                    'name' => $item
                )
            );
        };
    }
}
