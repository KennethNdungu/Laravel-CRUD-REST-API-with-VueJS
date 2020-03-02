<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'user_id'=>1,
        'name'=>$faker->name,
        'description'=>$faker->paragraph(1),
        'quantity'=>2,
    ];
});
