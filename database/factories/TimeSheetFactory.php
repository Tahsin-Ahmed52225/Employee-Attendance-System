<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Timer;
use Faker\Generator as Faker;
use Carbon\Carbon;

$factory->define(Timer::class, function (Faker $faker) {
    return [
        'user_id' => $faker->numberBetween(1, 6),
        'check_in' => Carbon::now(),
        'check_out' => Carbon::tomorrow(),
        'total_time' => $faker->randomDigitNotNull(),
        'daily_update' => $faker->paragraph,
        'status' => $faker->randomElement(['FD', 'HO']),
    ];
});
