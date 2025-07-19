<?php
namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    public function run()
    {
        $brands = [
            ['name' => 'Honda', 'slug' => 'honda', 'description' => 'Leading Japanese motorcycle manufacturer.', 'is_active' => true, 'sort_order' => 1],
            ['name' => 'Yamaha', 'slug' => 'yamaha', 'description' => 'Known for performance and style.', 'is_active' => true, 'sort_order' => 2],
            ['name' => 'Suzuki', 'slug' => 'suzuki', 'description' => 'Reliable and affordable motorcycles.', 'is_active' => true, 'sort_order' => 3],
            ['name' => 'Kawasaki', 'slug' => 'kawasaki', 'description' => 'High-performance sport bikes.', 'is_active' => true, 'sort_order' => 4],
            ['name' => 'Vespa', 'slug' => 'vespa', 'description' => 'Iconic Italian scooters.', 'is_active' => true, 'sort_order' => 5],
        ];

        foreach ($brands as $brand) {
            Brand::create($brand);
        }
    }
}