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
            'email' => 'pepe@test.com',
            'name' => 'pepe',
            'email_verified_at' => now(),
            'password' => bcrypt('test')
        ));
        User::create(array(
            'email' => 'luis@test.com',
            'name' => 'luis',
            'email_verified_at' => now(),
            'password' => bcrypt('test')
        ));
        User::create(array(
            'email' => 'carlos@test.com',
            'name' => 'carlos',
            'email_verified_at' => now(),
            'password' => bcrypt('test')
        ));
        User::create(array(
            'email' => 'daina@test.com',
            'name' => 'daina',
            'email_verified_at' => now(),
            'password' => bcrypt('test')
        ));
        User::create(array(
            'email' => 'lucia@test.com',
            'name' => 'lucia',
            'email_verified_at' => now(),
            'password' => bcrypt('test')
        ));
    }
}
