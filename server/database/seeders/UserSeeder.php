<?php

namespace Database\Seeders;

use App\Enums\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123456'),
            'role' => Role::ADMIN,
        ]);
        User::create([
            'name' => 'yard owner',
            'email' => 'yardowner@gmail.com',
            'password' => bcrypt('123456'),
            'role' => Role::YARD_OWNER,
        ]);
        for ($i = 0; $i < 100; $i++) {
            User::create([
                'name' => 'Customer ' . $i + 1,
                'email' => 'customer' . $i + 1 . '@gmail.com',
                'password' => bcrypt('123456'),
                'role' => Role::CLIENT,
            ]);
        }
    }
}
