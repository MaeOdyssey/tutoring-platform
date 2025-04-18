<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            ['name' => 'Alice Nguyen', 'email' => 'alice@example.com'],
            ['name' => 'Jamal Turner', 'email' => 'jamal@example.com'],
            ['name' => 'Sofia Ruiz', 'email' => 'sofia@example.com'],
            ['name' => 'Daniel Okafor', 'email' => 'daniel@example.com'],
            ['name' => 'Rina Patel', 'email' => 'rina@example.com'],
        ];

        foreach ($users as $user) {
            User::create([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => Hash::make('password123'), // default password
            ]);
        }
    }
}
