<?php

use Faker\Generator as Faker;

$factory->define(App\Medien::class , function (Faker $faker) {
    return [
        'title' => $faker->name,
        'nr' => $faker->unique()->numberBetween(1,1000000),
        'barcode' => $faker->isbn13,
        'id_medium_type' => 1,
        'isbn13' => $faker->isbn13,
        'author' => $faker->firstName.",".$faker->lastName,
        'title' => $faker->name,
        'content' => $faker->text,
        'edition' => $faker->name,
        'pages' =>$faker->numberBetween(1,50000),
        'publisher' => $faker->name,
        'published_date'=>$faker->year,
        'published_location'=> $faker->city,
        'serie'=> $faker->name,
        'signatur'=>$faker->year,
        'category'=>'unknown',
        'lib_location'=>'test',
        'lib_added_date'=>$faker->dateTime,
        'lib_removed_date'=>$faker->dateTime,
        'status'=>'test'
    ];
    
});