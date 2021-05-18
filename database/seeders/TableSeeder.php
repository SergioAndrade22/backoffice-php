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
            'Junto a la barra',
            'Al lado de la ventana',
            'Al lado de la escalera',
            'Mesa principal arriba',
            'Junto a la barra',
            'Junto a la entrada',
            'Segunda mesa arriba',
            'Patio interno',
            'Patio interno'
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
