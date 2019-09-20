<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Conversation;
use App\User;
use Faker\Generator as Faker;

$factory->define(Conversation::class, function (Faker $faker) {

    return [
        'user_id' => $user_id = User::all()->random()->id,
        'contact_id' => User::where('id', '!=', $user_id)->get()->random()->id,
    ];
});
