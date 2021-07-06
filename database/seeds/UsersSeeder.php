<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('secret'),
            'role' => 'admin'
        ]);
        
        App\User::create([
            'name' => 'customer',
            'email' => 'customer@gmail.com',
            'password' => Hash::make('secret'),
            'role' => 'customer'
        ]);
    }
}
