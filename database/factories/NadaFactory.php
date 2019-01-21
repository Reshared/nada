<?php

use Faker\Generator as Faker;

$factory->define(App\Role::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->word,
        'created_at' => now(),
        'updated_at' => now(),
    ];
});

$factory->define(App\Permission::class, function (Faker $faker) {
    $name = $faker->unique()->sentence();
    return [
        'name' => $name,
        'path' => '/'.$name,
        'mod' => rand(0, 3),
        'created_at' => now(),
        'updated_at' => now(),
    ];
});