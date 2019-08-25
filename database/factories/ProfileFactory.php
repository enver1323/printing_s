<?php


/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Domain\User\Entities\Profile;
use App\Domain\User\Entities\User;
use Faker\Generator as Faker;


$factory->define(Profile::class, function (Faker $faker) {
    $user = User::count() ? User::inRandomOrder()->first() : factory(User::class)->create();
    return [
        'user_id' => $user->id,
        'name' => $faker->name,
        'family_name' => $faker->name,
        'birth_date' => time(),
        'photo' => null,
        'nickname' => $faker->name,
        'gender' => Profile::GENDER_MALE,
        'country_id' => null,
        'created_at' => time(),
        'updated_at' => time()
    ];
});
