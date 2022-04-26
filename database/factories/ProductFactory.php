<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'id'=>$faker->text(5),
        'title'=>$faker->company(90),
        'description'=>$faker->text(255),
        'price'=>$faker->randomDigitNotNull(50),
        'company_id'=>1,
        'category_id'=>1
    ];
});
