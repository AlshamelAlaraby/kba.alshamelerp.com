<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Modules\Category\Models\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'parent_id' => optional(Category::query()->inRandomOrder()->first())->id
    ];
});
