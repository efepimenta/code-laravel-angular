<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(CodeProject\Entities\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(CodeProject\Entities\OauthClient::class, function (Faker\Generator $faker) {
    return [
        'id' => 'appid1',
        'secret' => 'secret',
        'name' => 'AngularAPP',
    ];
});

$factory->define(CodeProject\Entities\Client::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'responsible' => $faker->name,
        'email' => $faker->email,
        'phone' => $faker->phoneNumber,
        'address' => $faker->address,
        'obs' => $faker->sentences(2, true),
    ];
});

$factory->define(CodeProject\Entities\Project::class, function (Faker\Generator $faker) {
    return [
        'owner_id' => rand(1, 5),
        'client_id' => rand(1, 10),
        'name' => $faker->name,
        'progress' => rand(1, 100),
        'description' => $faker->sentences(2, true),
        'status' => rand(1, 3),
        'due_date' => $faker->dateTime,
    ];
});

$factory->define(CodeProject\Entities\ProjectNote::class, function (Faker\Generator $faker) {
    return [
        'project_id' => rand(1, 5),
        'title' => $faker->title,
        'note' => $faker->paragraph,
    ];
});

$factory->define(CodeProject\Entities\ProjectTask::class, function (Faker\Generator $faker) {
    return [
        'project_id' => rand(1, 5),
        'name' => $faker->name,
        'start_date' => $faker->dateTime,
        'due_date' => $faker->dateTime,
        'status' => rand(1, 3),
    ];
});

$factory->define(CodeProject\Entities\ProjectMember::class, function (Faker\Generator $faker) {
    return [
        'project_id' => rand(1, 5),
        'member_id' => rand(1, 5),
    ];
});