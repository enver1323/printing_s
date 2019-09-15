<?php


use App\Domain\Brand\Entities\Brand;
use Illuminate\Database\Seeder;

class BrandsTableSeeder extends Seeder
{
    public function run()
    {
        Brand::firstOrCreate([
            'name->en' => 'Renz',
            'description->en' => 'German company',
        ]);
    }
}
