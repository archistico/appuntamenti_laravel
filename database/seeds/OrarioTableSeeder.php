<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use App\Orario;

class OrarioTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Orario::truncate();

        $sql = 'insert into orarios (giorno, ora, attivo, created_at) values (:giorno, :ora, :attivo, :created_at)';

        $giorni = ['lun', 'mar', 'mer', 'gio', 'ven', 'sab', 'dom'];
        $orari = [
            '8:00',  '8:15', '8:30', '8:45',
            '9:00',  '9:15', '9:30', '9:45',
            '10:00', '10:15', '10:30', '10:45',
            '11:00', '11:15', '11:30', '11:45',
            '12:00', '12:15', '12:30', '12:45',
            '13:00', '13:15', '13:30', '13:45',
            '14:00', '14:15', '14:30', '14:45',
            '15:00', '15:15', '15:30', '15:45',
            '16:00', '16:15', '16:30', '16:45',
            '17:00', '17:15', '17:30', '17:45',
            '18:00', '18:15', '18:30', '18:45',
            '19:00'
        ];

        $id = 1;

        foreach ($giorni as $g) {
            for($i = 0; $i<(count($orari)-1); $i++) {

                if(($id >= 3 && $id <= 16) || ($id >= 25 && $id <= 32) || ($id >= 47 && $id <= 60) || ($id >= 91 && $id <= 104) || ($id >= 137 && $id <= 148) || ($id >= 201 && $id <= 212)) {
                    DB::statement($sql, [
                        'giorno'=> $g,
                        'ora'=> $orari[$i].' - '.$orari[$i+1],
                        'attivo'=> 1,
                        'created_at' => Carbon::now()
                    ]);
                } else {
                    DB::statement($sql, [
                        'giorno'=> $g,
                        'ora'=> $orari[$i].' - '.$orari[$i+1],
                        'attivo'=> 0,
                        'created_at' => Carbon::now()
                    ]);
                }

                $id++;
            }
        }


        /*
        DB::statement($sql, [
            'giorno'=> '',
            'ora'=> '',
            'attivo'=> 0,
            'created_at' => Carbon::now()
        ]);
        */

    }
}
