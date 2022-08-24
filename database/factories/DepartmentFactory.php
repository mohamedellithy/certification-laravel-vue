<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use App\Department;
$factory->define(Department::class, function (Faker $faker) {
    return [
        //
        'name'                   => $faker->name,
        'slug'                   => $faker->slug,
        'have_child_departments' => rand(0,1),
        'parent_id'              => null,
        'active'                 => 1,
        'description'            => $faker->text
    ];
});
