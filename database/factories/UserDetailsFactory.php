<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\UserDetail;
use App\Country;
use App\User;
use Faker\Generator as Faker;

$factory->define(UserDetail::class, function (Faker $faker) {
    return [
        'citizenship_country_id' => Country::all()->random()->id,
        'first_name' => $faker->name,
        'last_name' => 'Snow',
        'phone_number' => $faker->phoneNumber
    ];
});
