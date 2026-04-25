<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DeveloperAdminSeeder extends Seeder
{
    public function run(): void
    {
        User::query()->firstOrCreate(
            ['email' => 'developer@mycityonly.com'],
            [
                'name' => 'Developer Admin',
                'password' => Hash::make('Dev@12345'),
                'role' => 'admin',
            ]
        );
    }
}

