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

        Schema::create('appuntamentos', function (Blueprint $table) {
            $table->increments('id');
            $table->date('data');
            $table->integer('orario_id')->unsigned();
            $table->string('nome',128);
            $table->string('note',128)->nullable();
            $table->timestamps();

            $table->foreign('orario_id')->references('id')->on('orarios')->onDelete('cascade')->onUpdate('cascade');
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
