<?php

$factory->define(App\Worker::class, function (Faker\Generator $faker) {
  return [
    'firstname' => $faker->firstName,
    'lastname' => $faker->lastName,
    'street_name' => $faker->address,
    'zip_code' => $faker->postcode,
    'photo' => $faker->image('storage/app/', 150, 150, 'cats'),
  ];
});