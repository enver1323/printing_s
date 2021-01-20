<?php


use App\Domain\Product\Entities\ProductOption;
use Illuminate\Database\Seeder;

class ProductOptionsTableSeeder extends Seeder
{
    public function run()
    {
        ProductOption::insert([[
            'name' => json_encode(['en' => 'A4']),
            'description' => json_encode(['en' => 'A4 size']),
            'created_by' => 1,
            'product_id' => 3,
            'created_at' => time(),
            'updated_at' => time()
        ],[
            'name' => json_encode(['en' => 'A5']),
            'description' => json_encode(['en' => 'A5 size']),
            'created_by' => 1,
            'product_id' => 3,
            'created_at' => time(),
            'updated_at' => time()
        ]]);
    }
}
