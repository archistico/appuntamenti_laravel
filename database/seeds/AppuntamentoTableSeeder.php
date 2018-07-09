<?php

use App\Appuntamento;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class AppuntamentoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Appuntamento::truncate();

        factory(Appuntamento::class, 50)->create();
    }
}
