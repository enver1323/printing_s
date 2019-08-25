<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Domain\Country\Entities\Country;
use App\Domain\Country\Entities\Region;
use Faker\Generator as Faker;

$factory->define(Region::class, function (Faker $faker){
    $slug = Str::slug($faker->unique()->country);
    return [
        'name->en' => $faker->country,
        'country_id' => Country::inRandomOrder()->first('id'),
        'slug' => $slug,
        'parent_id' => null,
        'lat' => $faker->latitude,
        'lng' => $faker->longitude,
    ];
});
