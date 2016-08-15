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

// Admin:
$factory->defineAs(App\User::class, 'admin', function (Faker\Generator $faker) {
    return [
        'username'  => $faker->userName,
        'email'     => $faker->email,
        'name'      => $faker->name,
        'remember_token' => str_random(10),
        'role'      => 'admin',
    ];
});

// User:
$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'username'  => $faker->username,
        'email'     => $faker->safeEmail,
        'email_public' => $faker->boolean($chanceOfGettingTrue = 50),
        'name'      => $faker->firstName($gender = 'male'|'female') . ' ' . $faker->lastName,
        'bio'       => $faker->sentence($nbWords = 20, $variableNbWords = true),
        'password'  => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

// Project:
$factory->define(App\Project::class, function (Faker\Generator $faker) {
    return [
        'name'      => ucfirst($faker->word),
        'description' => $faker->sentence($nbWords = 20, $variableNbWords = true),
        'created_at' => $faker->dateTimeBetween($startDate = '-3 months', $endDate = 'now', $timezone = date_default_timezone_get()),
    ];
});

// Quest:
$factory->define(App\Quest::class, function (Faker\Generator $faker) {
    return [
        'name'      => ucfirst($faker->word),
        'description' => $faker->sentence($nbWords = 20, $variableNbWords = true),
        'language'  => $faker->randomElement(array_keys(Quest::getLanguages())),
        'difficulty' => $faker->randomElement(array_keys(Quest::getDifficulties())),
        'created_at' => $faker->dateTimeBetween($startDate = '-3 months', $endDate = 'now', $timezone = date_default_timezone_get()),
    ];
});
