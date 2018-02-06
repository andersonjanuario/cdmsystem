<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbCdmVisitanteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_cdm_visitante', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome',255);
            $table->string('cpf',15)->nullable();
            $table->binary('foto')->nullable();
            $table->integer('idade')->nullable();
            $table->string('descricao',255)->nullable();
            $table->string('fone_principal',15)->nullable();            
            
//            $table->dateTime('entrada');
//            $table->dateTime('saida')->nullable();
            $table->string('rg',20)->nullable();
            
            //$table->integer('tb_cdm_morador_id')->unsigned();
            //$table->foreign('tb_cdm_morador_id')->references('id')->on('tb_cdm_morador')->onDelete('cascade');
                        
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
        Schema::dropIfExists('tb_cdm_visitante');
    }
}
