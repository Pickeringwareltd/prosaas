<?php

use Faker\Generator as Faker;
// require '../../vendor/autoload.php';

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

$factory->define(App\Contact::class, function (Faker $faker) {
	$faker->addProvider(new CompanyNameGenerator\FakerProvider($faker));
    return [
        'name' => $faker->companyName,
        'type' => 'Supplier',
        'sector' => 'Warehouse',
        'company_logo' => $faker->image('public/storage/images',400,300, null, false),
        'created_at' => now(),
        'updated_at' => now(),
    ];
});
