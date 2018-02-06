<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbCdmMoradorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_cdm_morador', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome',255);
            $table->string('email',50)->nullable()->unique();
            $table->string('cpf',15)->nullable();
            $table->string('inquilino',1)->default('N')->comment = "N=Não,S=Sim";
            $table->binary('foto')->nullable();
            $table->integer('idade')->nullable();
            $table->dateTime('entrada')->nullable();
            $table->dateTime('saida')->nullable();
            $table->integer('status');
            $table->string('rg',20)->nullable();
            $table->string('fone_principal',15)->nullable();
            $table->string('fone_secundario',15)->nullable();
            
            
            $table->integer('apartamento_id')->unsigned();
            $table->foreign('apartamento_id')->references('id')->on('tb_cdm_apartamento')->onDelete('cascade');
            
            $table->integer('parentesco_id')->unsigned();
            $table->foreign('parentesco_id')->references('id')->on('tb_cdm_parentesco')->onDelete('cascade');
            
            
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
        Schema::dropIfExists('tb_cdm_morador');
    }
}
