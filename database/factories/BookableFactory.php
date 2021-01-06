<?php

/** @var Factory $factory */

use App\Bookable;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\Arr;

$data = [
    'Villa',
    'Hounse',
    'Cattage',
    'Luxury Villas',
    'Cheap Hounse',
    'Rooms',
    'Cheap Rooms',
    'Luxury Rooms',
    'Funcy Room'
];

$factory->define(Bookable::class, function (Faker $faker) use ($data) {

    return [
        'title' => $faker->city . '' . Arr::random($data),
        'description' => $faker->text()
    ];
});
