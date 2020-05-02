<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDadosRecomendanteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dados_recomendante', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('id_recomendante');
            $table->foreign('id_recomendante')->references('usuario_id')->on('users')->onDelete('cascade');
            $table->text('instituicao');
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
        Schema::dropIfExists('dados_recomendante');
    }
}
