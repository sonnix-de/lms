<?php

use Faker\Generator as Faker;
use Illuminate\Support\Facades\App;
use App\Article;

/**
 * Verwendung der Factory
 * composer dump-autoload
 * php artisan tinker
 * $articles = factory(App\article::class,1)->create();
 */
$factory->define(Article::class, function (Faker $faker) {

    $paragpraphs = [];

    for ($i = 1; $i < rand(3, 4); $i++) {
        $paragpraphs[] = [
            'category' => 'image',
            'title' => $faker->name,
            'text' => $faker->text,
            'position' => [
                'width' => rand(1, 5),
                'height' => 'auto'
            ],
        ];
    }

    return [
        'title' => 'home', //$faker->name
        'teaser' => $faker->text,
        'content' => json_encode($paragpraphs),
        'online' => '2017-12-12',
        'offline' => '2019-12-12'
    ];
});
