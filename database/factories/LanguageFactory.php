<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */


use App\Domain\Translation\Entities\Language;
use Faker\Generator as Faker;

$factory->define(Language::class, function (Faker $faker) {
    $code = $faker->unique()->languageCode;
    return [
        'code' => $code,
        'name' => sprintf("%s language", ucfirst($code))
    ];
});
