<?php

use Faker\Generator as Faker;

$factory->define(App\src\Models\News::class, function (Faker $faker) {
    return [
        'name' => 'dummy_news_name',
        'description' => 'dummy_news_description',
    ];
});
