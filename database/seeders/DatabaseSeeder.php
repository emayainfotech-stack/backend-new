<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        User::query()->firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('admin12345'),
                'role' => 'admin',
            ]
        );

        User::query()->firstOrCreate(
            ['email' => 'reporter@example.com'],
            [
                'name' => 'Reporter',
                'password' => Hash::make('reporter12345'),
                'role' => 'reporter',
            ]
        );

        $defaults = ['Politics', 'Sports', 'Local'];
        foreach ($defaults as $name) {
            $slug = \Illuminate\Support\Str::slug($name);
            Category::query()->firstOrCreate(['slug' => $slug], ['name' => $name, 'slug' => $slug]);
        }
    }
}
