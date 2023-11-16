<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // Clear existing users
        User::truncate();

        // Create dummy users
        User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
        ]);

        User::create([
            'name' => 'admin2',
            'email' => 'admin2@admin.com',
            'password' => Hash::make('password2'),
        ]);

        // Add more user records if needed

        // Output success message
        $this->command->info('Users table seeded successfully.');
    }
}
