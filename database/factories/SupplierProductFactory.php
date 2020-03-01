<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\SupplierProduct;
use Faker\Generator as Faker;

$factory->define(SupplierProduct::class, function (Faker $faker) {
    return [
        'supply_id'=>4,
        'product_id'=>5
    ];
});
