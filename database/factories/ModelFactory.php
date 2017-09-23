<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Boxer::class, function (Faker\Generator $faker) {
    static $password;
    $array = ['welterweight', 'middleweight', 'lightweight', 'featherweight', 'heavyweight'];
    return [
        'name' => $faker->firstNameMale . ' ' .$faker->lastName,
        'division' => $faker->randomElement($array),
        'win' => $wins = $faker->numberBetween($min = 0, $max = 50),
        'loss' => $faker->numberBetween($min = 0, $max = 10),
        'knockouts' => $faker->numberBetween($min = 0, $max = $wins),
        'draws' => $faker->numberBetween($min = 0, $max = 5),
        'power' => $faker->numberBetween($min = 10, $max = 99),
        'speed' => $faker->numberBetween($min = 10, $max = 99),
        'stamina' => $faker->numberBetween($min = 10, $max = 99),
        'chin' => $faker->numberBetween($min = 10, $max = 99),
        'offense' => $faker->numberBetween($min = 10, $max = 99),
        'defense' => $faker->numberBetween($min = 10, $max = 99),
        'popularity' => $faker->numberBetween($min = 10, $max = 99),
        'potential' => $faker->numberBetween($min = 10, $max = 99),
        'contract' => 0,
        'health' => $faker->numberBetween($min = 0, $max = 99),
        'game_id' => '1',
        'promoter_id' => $faker->numberBetween($min = 1, $max = 4)
    ];
});
