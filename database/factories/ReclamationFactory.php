<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(Model\Reclamation::class, function (Faker $faker) {
    $users = App\Model\User::all()->pluck('id')->toArray();
    $parcel = App\Model\Parcel::all()->pluck('id')->toArray();

    return [
        'title' =>$faker->text($maxNbChars = 6),
        'description' =>$faker->text($maxNbChars = 6),
        'parcel_id' =>$faker->randomElement($parcel),
        'user_id' =>$faker->randomElement($users),


    ];
});
