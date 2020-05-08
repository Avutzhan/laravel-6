<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'body' => $faker->paragraph,
    ];
});

// php artisan tinker
//factory(App\Post::class)->create();
// dont forget to restart tinker
// factory(App\Post::class)->create(['user_id' => 2]);
//select * from posts where user_id = 2; //sql console
//$user = App\User::find(2); //in tinker
