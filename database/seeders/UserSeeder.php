<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin
        User::updateOrCreate(
            ['email' => 'zhafirjack+admin@gmail.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('admin12345'),
                'role' => 'admin',
                'email_verified_at' => now(), // optional
            ]
        );

        // Job Seeker
        User::updateOrCreate(
            ['email' => 'zhafirjack+seeker@gmail.com'],
            [
                'name' => 'ZhafirSeeker',
                'password' => Hash::make('seeker12345'),
                'role' => 'user',
                'email_verified_at' => now(), // optional
            ]
        );
    }
}
