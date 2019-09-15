<?php


use App\Domain\Product\Entities\Product;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    public function run(): void
    {
        Product::firstOrCreate([
            'name->en' => 'TC 20',
            'description->en' => 'Reliable, desktop, hand thumb cut calendar punch machine producing a 20 mm thumb cut',
            'category_id' => 1,
            'brand_id' => 1,
            'line_id' => 1,
            'created_by' => 1,
        ]);

        Product::firstOrCreate([
            'name->en' => 'DTP 340 A',
            'description->en' => 'Fast and reliable, heavy-duty, semi-automatic, desktop punching machine. Very versatile machine for all types of book and calendar punching production up to 340 mm in width.',
            'category_id' => 1,
            'brand_id' => 1,
            'line_id' => 1,
            'created_by' => 1,
        ]);

        Product::firstOrCreate([
            'name->en' => 'Plastic Combs',
            'description->en' => 'High quality plastic combs to fit all plastic binding machines.',
            'category_id' => 3,
            'brand_id' => 1,
            'line_id' => 4,
            'created_by' => 1,
        ]);
    }
}
