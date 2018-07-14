<?php

$factory->define(App\Contract::class, function (Faker\Generator $faker) {
  return [
    'start_date' => $faker->dateTime,
    'end_date' => $faker->dateTime,
    'termination_date' => $faker->dateTime,
    'status' => $faker->randomElement([
      /* 'ACTIVE', */
      'EXPIRED',
      'CANCELED',
    ]),
    'salary' => $faker->randomFloat(null, 1, 99999999999.9999),
    'with_social_security' => $faker->boolean,
  ];
});