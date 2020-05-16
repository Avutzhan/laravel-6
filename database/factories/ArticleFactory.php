<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Article;
use Faker\Generator as Faker;

$factory->define(Article::class, function (Faker $faker) {
    return [
        'user_id' => factory(\App\User::class),
        'title' => $faker->sentence,
        'excerpt' => $faker->sentence,
        'body' => $faker->paragraph

    ];
});
//php artisan make:factory ArticleFactory -m "App\Article"
//factory(App\Article::class, 5)->create(['title' => 'overrided']);
//you can override tables data
