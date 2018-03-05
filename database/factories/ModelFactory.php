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
$factory->define(\CodeFinances\Models\User::class, function (Faker\Generator $faker) {
    
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});


$factory->state(\CodeFinances\Models\User::class, 'admin', function (Faker\Generator $faker) {
    return [
        'role' => \CodeFinances\Models\User::ROLE_ADMIN
        #'role' => 'admin'
    ];
});

$factory->define(\CodeFinances\Models\BankAccount::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->city,
        'agency' => rand(10000, 60000).'-'.rand(0,9),
        'account' => rand(70000, 260000).'-'.rand(0,9)
    ];
});

$factory->define(\CodeFinances\Models\Client::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name
    ];
});

$factory->define(\CodeFinances\Models\CategoryExpense::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name
    ];
});

$factory->define(\CodeFinances\Models\CategoryRevenue::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name
    ];
});

$factory->define(\CodeFinances\Models\BillPay::class, function (Faker\Generator $faker) {
    return [
        'date_due' => $faker->date(),
        'name' => $faker->word,
        'value' => $faker->numberBetween(10,1000),
        'done' => rand(0,1)
    ];
});

