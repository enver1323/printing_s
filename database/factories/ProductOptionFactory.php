<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */


use App\Domain\Product\Entities\Product;
use App\Domain\Product\Entities\ProductOption;
use Faker\Generator as Faker;

$factory->define(ProductOption::class, function (Faker $faker){
    $count = Product::count();
    return [
        'name->en' => $faker->company,
        'description->en' => $faker->words,
        'product_id' => $faker->numberBetween(1, $count),
        'created_by' => 1,
        'created_at' => time(),
        'updated_at' => time(),
    ];
});
