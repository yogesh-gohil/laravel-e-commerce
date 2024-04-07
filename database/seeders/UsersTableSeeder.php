<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'email' => 'admin@gmail.com',
            'name' => 'Yogesh Gohil',
            'status' => 'ACTIVE',
            'role' => User::ROLE_ADMIN,
            'phone' => '8855445544',
            'password' => 'admin@123'
        ]);

        // User::create([
        //     'email' => 'test@gmail.in',
        //     'name' => 'Test User',
        //     'status' => 'ACTIVE',
        //     'role' => User::ROLE_USER,
        //     'phone' => '5555555555',
        //     'password' => 'Passw0rd'
        // ]);
    }
}
