<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Item;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $itemName = ["Gnocchi alla Bolognese", "Sushi", "Goulash"];
        $itemCuisine = ["Italian", "Japanese", "Hungarian"];
        $itemVege = [false, false, false];
        $itemVegan = [false, false, false];
        $itemCoeliac = [false, true, false];
        $itemAlcohol = [false, false, false];
        $itemCost = [20, 35, 15];
        for ($i = 0; $i < 3; $i++) {
            Item::create(
                array(
                    'name' => $itemName[$i],
                    'cuisine' => $itemCuisine[$i],
                    'is_vege' => $itemVege[$i],
                    'is_vegan' => $itemVegan[$i],
                    'is_coeliac' => $itemCoeliac[$i],
                    'has_alcohol' => $itemAlcohol[$i],
                    'cost' => $itemCost[$i],
                )
            );
        };
    }
}
