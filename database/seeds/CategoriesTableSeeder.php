<?php


use \App\Domain\Category\Entities\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    public function run()
    {
        Category::firstOrCreate(['name->en' => 'Punching']);
        Category::firstOrCreate(['name->en' => 'Ring Wire']);
        Category::firstOrCreate(['name->en' => 'Plastic Comb']);
    }
}
