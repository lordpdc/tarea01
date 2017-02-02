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
$factory->define(App\Address::class, function (Faker\Generator $faker) {

    return [
        'city' => $faker->city,
        'state' => $faker->city,
        'country' => $faker->country,
        'zip_code'=>$faker->postcode,
        'address'=>$faker->streetAddress
    ];
});
$factory->define(App\Seller::class, function (Faker\Generator $faker) {

    return [
        'name' => $faker->name,
        'last_name' => $faker->lastName,
        'address_id' => factory(\App\Address::class)->create()->id
    ];
});
$factory->define(App\Product::class, function (Faker\Generator $faker) {

    return [
        'name' => $faker->name,
        'price' => $faker->randomFloat(2, 1, 500),
        'description' => $faker->text
    ];
});
$factory->define(App\Review::class, function (Faker\Generator $faker) {

    return [
        'critic_name' => $faker->name,
        'title' => $faker->title,
        'content' => $faker->text,
        'date' => $faker->date('Y-m-d'),
    ];
});
$factory->define(App\Tag::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
    ];
});