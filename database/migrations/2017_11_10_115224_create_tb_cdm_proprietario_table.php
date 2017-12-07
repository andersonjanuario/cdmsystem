<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbCdmProprietarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_cdm_proprietario', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome',255);
            $table->string('email',50)->nullable()->unique();
            $table->string('cpf',15)->nullable();
            $table->string('rg',15)->nullable();
            $table->binary('foto')->nullable();
            $table->string('adimplente',1)->nullable()->default('S')->comment = "N=Não,S=Sim";
            $table->decimal('debito', 8, 2)->nullable();
            $table->string('morador',1)->default('S')->comment = "N=Não,S=Sim";
            $table->string('fone_principal',15)->nullable();
            $table->string('fone_secundario',15)->nullable();
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
        Schema::dropIfExists('tb_cdm_proprietario');
    }
}
