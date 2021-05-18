<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Table;

class TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cantPersonas = [1,2,3,5,1,2,4,3,2];

        $descripcion = [
            'By the bar',
            'By the window',
            'By the stairs',
            'Main table 2nd floor',
            'By the bar',
            'By the entrance',
            'Second table 2nd floor',
            'Outside',
            'Outside'
        ];
        
        for ($i = 0; $i < 9; $i++){
            Table::create(
                array(
                    'cant_personas' => $cantPersonas[$i],
                    'descripcion' => $descripcion[$i],
                )
            );
        }
    }
}
