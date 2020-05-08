<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(App\Affiliation::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->word
    ];
});
//factory('App\User')->create(); to start factory user
//factory('App\User')->create(['affiliation_id' => 1]);
//select id from users where affiliation_id = 1;
//select * from users where affiliation_id = 1;
//select * from posts where user_id in (1, 2);
//select * from posts where user_id in (5, 6);
//dont forget to run factory adn fill models with data
