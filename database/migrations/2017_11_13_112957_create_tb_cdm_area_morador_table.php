<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbCdmAreaMoradorTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('tb_cdm_area_morador', function (Blueprint $table) {
            $table->integer('area_id')->unsigned();
            $table->foreign('area_id')->
                    references('id')->
                    on('tb_cdm_area');

            $table->integer('morador_id')->unsigned();
            $table->foreign('morador_id')->
                    references('id')->
                    on('tb_cdm_morador');
            
            $table->dateTime('reserva');
            $table->string('status',1)->default('R')->comment = "R=Reservado,C=Cancelado,P=Pendente";
            $table->double('saldo',8,2)->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('tb_cdm_area_morador');
    }

}
