<?php

use App\Appuntamento;
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
        $data = $faker->dateTimeBetween($startDate = '-14 days', $endDate = 'now', $timezone = null);
        $NumberDayOfWeek = $data->format('w');
        $days = array('dom', 'lun', 'mar', 'mer', 'gio', 'ven', 'sab');
        $dayOfWeek = $days[$NumberDayOfWeek];
    } while ($NumberDayOfWeek < 1 || $NumberDayOfWeek > 5);

    // tiro a caso un orario attivo
    $orario_id = Orario::inRandomOrder()->where('attivo', 1)->where('giorno', $dayOfWeek)->first()->id;

    return [
        'data' => $data,
        'orario_id' => $orario_id,
        'nome' => $faker->name(),
        'note' => $faker->text(20),
        'created_at' => Carbon::now()
    ];


    /*

    $apps = Appuntamento::get();
    echo $apps->count()."\n";

    if($apps->count()>0) {
        foreach($apps as $app1) {
            foreach($apps as $app2) {
                if(($app1->data != $app2->data) && ($app1->orario_id != $app2->orario_id) && ($app1->id != $app2->id)) {
                    return [
                        'data' => $data,
                        'orario_id' => $orario_id,
                        'nome' => $faker->name(),
                        'note' => $faker->text(20),
                        'created_at' => Carbon::now()
                    ];
                }
            }
        }
    } else {
        // Se è il primo che tiro a sorte
        return [];
    }

     */


    /*
    // controllo che a quel orario non abbia già un altro appuntamento
    if(Appuntamento::all()->count() > 1) {
        $app =  Appuntamento::where('data', $data->format('Y-m-d'))->where('orario_id', $orario_id)->first();
    } else {
        return [
            'data' => $data,
            'orario_id' => $orario_id,
            'nome' => $faker->name(),
            'note' => $faker->text(20),
            'created_at' => Carbon::now()
        ];
    }

    if($app) {
        return [
            'data' => $data,
            'orario_id' => $orario_id,
            'nome' => $faker->name(),
            'note' => $faker->text(20),
            'created_at' => Carbon::now()
        ];
    } else {
        return [];
    }
    */

});

