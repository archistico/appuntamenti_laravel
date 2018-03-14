<?php

use App\Orario;
use Faker\Generator as Faker;
use Illuminate\Support\Carbon;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Appuntamento::class, function (Faker $faker) {

    // Attenzione posso tirare a caso una data che non ha appuntamenti disponibili
    do {
        $data = $faker->dateTimeBetween($startDate = '-1 months', $endDate = 'now', $timezone = null);
        $NumberDayOfWeek = $data->format('w');
        $days = array('dom', 'lun', 'mar', 'mer', 'gio', 'ven', 'sab');
        $dayOfWeek = $days[$NumberDayOfWeek];
    } while ($NumberDayOfWeek < 1 || $NumberDayOfWeek > 5);

    $orario_id = Orario::inRandomOrder()->where('attivo', 1)->where('giorno', $dayOfWeek)->first()->id;

    return [
        'data' => $data,
        'orario_id' => $orario_id,
        'nome' => $faker->name(),
        'note' => $faker->text(20),
        'created_at' => Carbon::now()
    ];
});

