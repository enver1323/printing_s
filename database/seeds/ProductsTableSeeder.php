<?php


use App\Domain\Product\Entities\Product;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    public function run(): void
    {
        Product::create([
            'name->en' => 'Nissan 240sx',
            'description->en' => 'JDM Legend',
            'category_id' => 6,
            'brand_id' => 1,
            'created_by' => 1,
            'lat' => 35.02107,
            'lng' => 135.75385,
        ]);
    }
}
