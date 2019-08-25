<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use \App\Domain\Category\Entities\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker){
    $name = $faker->word;
    return [
        'name->en' => $name,
        'description->en' => $name,
        'slug' => $faker->slug,
        'photo' => null,
    ];
});
