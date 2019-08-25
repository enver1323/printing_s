<?php


use App\Domain\Product\Entities\ProductOption;
use Illuminate\Database\Seeder;

class ProductOptionsTableSeeder extends Seeder
{
    public function run()
    {
        ProductOption::create([
            'name->en' => 'S14 chassis',
            'description->en' => 'Second generation',
            'category_id' => 1,
            'created_by' => 1,
        ]);
    }
}
