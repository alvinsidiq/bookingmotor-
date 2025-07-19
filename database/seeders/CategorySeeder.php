<?php
namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            ['name' => 'Sport', 'slug' => 'sport', 'description' => 'Sport motorcycles for high performance.', 'is_active' => true, 'sort_order' => 1],
            ['name' => 'Matic', 'slug' => 'matic', 'description' => 'Automatic scooters for easy riding.', 'is_active' => true, 'sort_order' => 2],
            ['name' => 'Manual', 'slug' => 'manual', 'description' => 'Manual motorcycles for classic riders.', 'is_active' => true, 'sort_order' => 3],
            ['name' => 'Electric', 'slug' => 'electric', 'description' => 'Eco-friendly electric motorcycles.', 'is_active' => true, 'sort_order' => 4],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}