<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create(array(
            'email' => 'test@test.com',
            'name' => 'test',
            'password' => bcrypt('test')
        ));
        User::create(array(
            'email' => 'pepe@test.com',
            'name' => 'pepe',
            'password' => bcrypt('test')
        ));
        User::create(array(
            'email' => 'luis@test.com',
            'name' => 'luis',
            'password' => bcrypt('test')
        ));
        User::create(array(
            'email' => 'carlos@test.com',
            'name' => 'carlos',
            'password' => bcrypt('test')
        ));
        User::create(array(
            'email' => 'daina@test.com',
            'name' => 'daina',
            'password' => bcrypt('test')
        ));
        User::create(array(
            'email' => 'lucia@test.com',
            'name' => 'lucia',
            'password' => bcrypt('test')
        ));
    }
}
