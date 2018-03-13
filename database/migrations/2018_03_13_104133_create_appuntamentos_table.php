<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppuntamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*
        `idapp` int(11) NOT NULL,
        `data` date NOT NULL,
        `fkorario` int(11) NOT NULL,
        `nome` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
        `note` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '-'
         */

        Schema::create('appuntamentos', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appuntamentos');
    }
}
