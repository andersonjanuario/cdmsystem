<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbCdmApartamentoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_cdm_apartamento', function (Blueprint $table) {
            $table->increments('id');
            $table->string('numero',3);
            $table->string('bloco',1);
            $table->string('bosque',1);
            $table->integer('proprietario_id')->unsigned();
            $table->foreign('proprietario_id')->references('id')->on('tb_cdm_proprietario')->onDelete('cascade');
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
        Schema::dropIfExists('tb_cdm_apartamento');
    }
}
