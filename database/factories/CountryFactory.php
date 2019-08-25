<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Domain\Country\Entities\Country;
use Faker\Generator as Faker;

$factory->define(Country::class, function (Faker $faker){
    $slug = Str::slug($faker->unique()->country);
    return [
        'name->en' => $faker->country,
        'slug' => $slug,
        'photo' => null,
        'code' => $faker->countryCode,
        'lat' => $faker->latitude,
        'lng' => $faker->longitude,
        'phone_code' => 1234
    ];
});
