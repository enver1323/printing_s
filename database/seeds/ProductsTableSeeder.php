<?php


use App\Domain\Product\Entities\Product;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    public function run(): void
    {
        Product::insert([[
            'name' => json_encode(['en' => 'TC 20']),
            'description' => json_encode(['en' => 'Reliable, desktop, hand thumb cut calendar punch machine producing a 20 mm thumb cut']),
            'category_id' => 1,
            'brand_id' => 1,
            'line_id' => 1,
            'created_by' => 1,
            'slug' => 'tc_20',
            'created_at' => time(),
            'updated_at' => time()
        ], [
            'name' => json_encode(['en' => 'DTP 340 A']),
            'description' => json_encode(['en' => 'Fast and reliable, heavy-duty, semi-automatic, desktop punching machine. Very versatile machine for all types of book and calendar punching production up to 340 mm in width.']),
            'category_id' => 1,
            'brand_id' => 1,
            'line_id' => 1,
            'created_by' => 1,
            'slug' => 'dtp_340_a',
            'created_at' => time(),
            'updated_at' => time()
        ], [
            'name' => json_encode(['en' => 'Plastic Combs']),
            'description' => json_encode(['en' => 'High quality plastic combs to fit all plastic binding machines.']),
            'category_id' => 3,
            'brand_id' => 1,
            'line_id' => 4,
            'created_by' => 1,
            'slug' => 'plastic_combs',
            'created_at' => time(),
            'updated_at' => time()
        ]]);
    }
}
