<?php


use App\Domain\Product\Entities\ProductOption;
use Illuminate\Database\Seeder;

class ProductOptionsTableSeeder extends Seeder
{
    public function run()
    {
        ProductOption::firstOrCreate([
            'name->en' => 'A4',
            'description->en' => 'A4 size',
            'created_by' => 1,
            'product_id' => 3
        ]);

        ProductOption::firstOrCreate([
            'name->en' => 'A5',
            'description->en' => 'A5 size',
            'created_by' => 1,
            'product_id' => 3
        ]);
    }
}
