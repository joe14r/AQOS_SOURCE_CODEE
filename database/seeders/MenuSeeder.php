<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 20; $i++) {
            Menu::create([
                'name' => 'Food Item ' . $i,
                'description' => fake()->paragraph(),
                'price' => fake()->randomFloat(2, 5, 50),
                'image' => 'uploads/menu/default.jpg', // assume a default image
                'status' => 'active',
            ]);
        }
    }
}

