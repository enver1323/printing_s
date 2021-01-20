<?php


use App\Domain\Brand\Entities\Brand;
use Illuminate\Database\Seeder;

class BrandsTableSeeder extends Seeder
{
    public function run()
    {
        Brand::insert([
            'name' => json_encode(['en' => 'Renz']),
            'description' => json_encode(['en' => 'German company']),
            'slug' => 'renz',
            'created_at' => time(),
            'updated_at' => time(),
        ]);
    }
}
