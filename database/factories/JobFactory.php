<?php

$factory->define(App\Job::class, function (Faker\Generator $faker) {
  return [
    'name' => $faker->randomElement([
      'FOREMAN',
      'ARCHITECT',
      'BRICKLAYER',
      'OPERATOR',
      'BUYER',
    ]),
    'description' => $faker->sentence,
  ];
});