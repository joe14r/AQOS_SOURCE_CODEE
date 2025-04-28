<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Table;
use Illuminate\Support\Str;

class TableSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            Table::create([
                'tid'=> uniqid(),
                'title' => "Table $i",
                'description' => fake()->sentence(),
                'image' => 'uploads/table/default.jpg', // assume a default image
                'status' => 'active',
            ]);
        }
    }
}
