<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'username' => 'superadmin',
                'name' => 'Super Admin',
                'email' => 'superadmin@mail.com',
                'password' => bcrypt('subang2025'),
            ],
            [
                'username' => 'kandi',
                'name' => 'Kandi Permana',
                'email' => 'kandi@mail.com',
                'password' => bcrypt('subang2025'),
            ]
        ];

        foreach ($users as $user) {
            User::create([
                'email' => $user['email'],
                'username' => $user['username'],
                'name' => $user['name'],
                'password' => $user['password'],
            ]);
        }
    }
}
