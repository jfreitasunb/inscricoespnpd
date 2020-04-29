<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLinkCartaRecomendacaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('link_carta_recomendacao', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('id_recomendante');
            $table->foreign('id_recomendante')->references('usuario_id')->on('users')->onDelete('cascade');
            $table->unsignedInteger('id_candidato');
            $table->foreign('id_candidato')->references('usuario_id')->on('users')->onDelete('cascade');
            $table->unsignedInteger('id_inscricao_pnpd');
            $table->foreign('id_inscricao_pnpd')->references('usuario_id')->on('users')->onDelete('cascade');
            $table->string('link_acesso', 100)->unique()->nullable();
            $table->integer('tamanho_link')->nullable();
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
        Schema::dropIfExists('link_carta_recomendacao');
    }
}
