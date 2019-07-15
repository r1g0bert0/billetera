<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Transfer;
use Faker\Generator as Faker;

$factory->define(Transfer::class, function (Faker $faker) {
    return [
        'amount'=>$faker->numberBetween($min=10,$max=90),
        'description'=>$faker->numberBetween($maxNbChars=200),
        'wallet_id'=>$faker->randomDigitNotNull
    ];
});
