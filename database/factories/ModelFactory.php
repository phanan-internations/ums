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
$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
    ];
});

$factory->define(App\Models\Group::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
    ];
});

$factory->define(App\Models\Administrator::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'username' => $faker->unique()->userName,
        'password' => bcrypt($faker->password),
        'api_token' => str_random(),
    ];
});

$factory->define(\App\Models\Membership::class, function (Faker\Generator $faker) {
    return [
        'group_id' => factory(\App\Models\Group::class)->create()->id,
        'user_id' => factory(\App\Models\User::class)->create()->id,
    ];
});

