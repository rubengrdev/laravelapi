<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Company;
use App\Model;
use Faker\Generator as Faker;

$factory->define(Company::class, function (Faker $faker) {
    return [
        //'company_id'=>$faker->number(),
        'id'=>"1",
        'name'=>$faker->word(25),
        'address'=>$faker->text(50),
        'desc'=>$faker->text(255),
    ];
});
