<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbCdmVisitanteMoradorTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('tb_cdm_visitante_morador', function (Blueprint $table) {
            $table->integer('visitante_id')->unsigned();
            $table->foreign('visitante_id')->
                    references('id')->
                    on('tb_cdm_visitante');

            $table->integer('morador_id')->unsigned();
            $table->foreign('morador_id')->
                    references('id')->
                    on('tb_cdm_morador');

            $table->dateTime('data_visita');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('tb_cdm_visitante_morador');
    }

}
