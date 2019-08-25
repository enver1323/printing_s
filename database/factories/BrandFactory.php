<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Domain\Brand\Entities\Brand;
use App\Domain\Category\Entities\Category;
use Faker\Generator as Faker;

$factory->define(Brand::class, function (Faker $faker){
    $name = $faker->company;
    $count = Category::count();
    return [
        'name->en' => $name,
        'description->en' => "$name Brand",
        'photo' => null,
        'slug' => $faker->slug,
        'category_id' => $faker->numberBetween(1, $count),
        'created_at' => time(),
        'updated_at' => time(),
    ];
});
