<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartaRecomendacaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carta_recomendacao', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('id_recomendante');
            $table->foreign('id_recomendante')->references('usuario_id')->on('users')->onDelete('cascade');
            $table->unsignedInteger('id_candidato');
            $table->foreign('id_candidato')->references('usuario_id')->on('users')->onDelete('cascade');
            $table->unsignedInteger('id_inscricao_pnpd');
            $table->foreign('id_inscricao_pnpd')->references('usuario_id')->on('users')->onDelete('cascade');
            $table->text('recomendacao');
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
        Schema::dropIfExists('carta_recomendacao');
    }
}
