<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(User::class, function (Faker $faker) {
    return [
        'email' =>$faker->email,
        'name' =>$faker->name,
        'password' => bcrypt('secret'),
        'role' =>$faker->numberBetween($min = 0, $max = 2),
        'cin' =>$faker->numberBetween($min = 00000000, $max = 99999999),
        'phone_number' =>$faker->phoneNumber,
        'adresse' =>$faker->address,
        'identity_card_image' =>$faker->imageUrl(),
        'driver_license_image' =>$faker->imageUrl(),
        'price_km'=>$faker->numberBetween($min = 00, $max = 99),
        'rapidity'=>$faker->numberBetween($min = 1, $max = 3),
        'Accepted'=>$faker->numberBetween($min = 0, $max = 1),


    ];
});
