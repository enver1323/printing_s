<?php


use \App\Domain\Category\Entities\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    public function run()
    {
        $accommodation = Category::create(['name->en' => 'Accommodation']);
        Category::create(['name->en' => 'Hotels', 'parent_id' => $accommodation->id]);
        Category::create(['name->en' => 'Motels', 'parent_id' => $accommodation->id]);
        Category::create(['name->en' => 'Hostels', 'parent_id' => $accommodation->id]);

        $transportation = Category::create(['name->en' => 'Transportation']);
        Category::create(['name->en' => 'Cars', 'parent_id' => $transportation->id]);
        Category::create(['name->en' => 'Yachts', 'parent_id' => $transportation->id]);
        $planes = Category::create(['name->en' => 'Planes', 'parent_id' => $transportation->id]);

        Category::create(['name->en' => 'Jets', 'parent_id' => $planes->id]);
    }
}
