<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Parcel;
use Faker\Generator as Faker;

$factory->define(Parcel::class, function (Faker $faker) {
    $users = App\Model\User::all()->pluck('id')->toArray();
    return [
        'description' =>$faker->text($maxNbChars = 20),
        'date'=>$faker->date,
        'status'=>$faker->numberBetween($min = 1, $max = 3),
        'cost'=>$faker->numberBetween($min = 10, $max = 70),
        'starting_adresse'=>$faker->address,
        'destination_adresse'=>$faker->address,
         'user_id' =>$faker->randomElement($users),
        'delivery_man_id'=>$faker->numberBetween($min = 0, $max = 0),
    ];
});
