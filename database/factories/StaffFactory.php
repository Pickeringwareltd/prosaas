<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Staff::class, function (Faker $faker) {
    return [
        'fullname' => $faker->name,
        'role' => 'staff',
        'profile_picture' => $faker->image('public/storage/images',400,300, null, false),
        'created_at' => now(),
        'updated_at' => now(),
    ];
});
