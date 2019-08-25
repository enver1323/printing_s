<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */


use App\Domain\Brand\Entities\Brand;
use App\Domain\Category\Entities\Category;
use App\Domain\Product\Entities\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker){
    $catCount = Category::count();
    $brandCount = Brand::count();
    return [
        'name->en' => $faker->company,
        'description->en' => $faker->words,
        'slug' => $faker->slug,
        'category_id' => $faker->numberBetween(1, $catCount),
        'brand_id' => $faker->numberBetween(1, $brandCount),
        'created_by' => 1,
        'created_at' => time(),
        'updated_at' => time(),
    ];
});
