<?php


use App\Domain\Brand\Entities\Brand;
use Illuminate\Database\Seeder;

class BrandsTableSeeder extends Seeder
{
    public function run()
    {
        Brand::firstOrCreate([
            'name->en' => 'Nissan',
            'description->en' => 'Japanese Car Manufacturer',
            'category_id' => 6,
            'slug' => 'nissan',
        ]);
    }
}
