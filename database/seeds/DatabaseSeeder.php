<?php

use Illuminate\Database\Seeder;

class  DatabaseSeeder extends Seeder
{
    public function run()
    {
         $this->call(UsersTableSeeder::class);
         $this->call(LanguagesTableSeeder::class);
         $this->call(CategoriesTableSeeder::class);
         $this->call(BrandsTableSeeder::class);
         $this->call(LinesTableSeeder::class);
         $this->call(ProductsTableSeeder::class);
         $this->call(ProductOptionsTableSeeder::class);
    }
}
