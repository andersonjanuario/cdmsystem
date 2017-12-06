<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbCdmVeiculoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_cdm_veiculo', function (Blueprint $table) {
            $table->increments('id');
            $table->string('descricao',1000);
            $table->string('placa',8)->unique();
            $table->string('cor',255)->nullable();
            $table->string('tipo',1)->default('C')->comment = "C=Carro,M=Motocicleta";
            $table->integer('apartamento_id')->unsigned();
            $table->foreign('apartamento_id')->references('id')->on('tb_cdm_apartamento')->onDelete('cascade');
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
        Schema::dropIfExists('tb_cdm_veiculo');
    }
}
