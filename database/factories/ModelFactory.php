<?php
require 'vendor/autoload.php';

use Carbon\Carbon;
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

$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'email' => $faker->safeEmail,
        'password' => $password ?: $password = bcrypt('secretsquirrel'),
        'title' => $faker->title($gender = null|'male'|'female'),
        'firstName' => $faker->firstName($gender = null|'male'|'female'),
        'lastName' => $faker->lastName,
        'suffix' => $faker->suffix,
        'streetAddress' => $faker->streetAddress,
        'city' => $faker->city,
        'state' => $faker->stateAbbr,
        'postalCode' => $faker->postcode,
        'phone' => $faker->phoneNumber,
        'newsletterOptIn' => $value = (bool)random_int(0,1),
        'avatar' => 'https://www.placecage.com/200/300',
        'nickname' => $faker->company,
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'is_admin' => $value = (bool)random_int(0,1)
    ];
});

$factory->define(App\Transactions::class, function (Faker\Generator $faker) {
    return [
      'stripe_trans_id' => str_random(10),
      'user_id' => rand(0,19),
      'trans_amount' =>
        money_format("%.2n",(float)rand()/(float)getrandmax()*100),
      'currency_id' => "USD",
      'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
      'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
    ];
});
