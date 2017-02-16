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
        'image' => $faker->imageUrl(40, 40, 'cats'),
    ];
});

$factory->define(App\Article::class, function (Faker\Generator $faker) {

    return [
        'title' => $faker->sentence,
        'content' => $faker->paragraphs($nbSentences = 6, $variableNbSentences = true),
        'user_id' => function () {
            return factory(App\User::class)->create()->id;
        },
        'image' => $faker->imageUrl(1000, 480, 'sports'),
    ];
});

$factory->define(App\Comment::class, function (Faker\Generator $faker) {

    return [
        'content' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
        'user_id' => function () {
            return factory(App\User::class)->create()->id;
        },
        'article_id' =>function () {
            return factory(App\Article::class)->create()->id;
        },
    ];
});