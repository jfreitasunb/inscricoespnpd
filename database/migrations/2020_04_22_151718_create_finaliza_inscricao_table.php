<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppModelsFinalizaInscricaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('finaliza_inscricao', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('id_inscricao_pnpd');
            $table->foreign('id_inscricao_pnpd')->references('usuario_id')->on('users')->onDelete('cascade');
            $table->unsignedInteger('usuario_id');
            $table->foreign('usuario_id')->references('usuario_id')->on('users')->onDelete('cascade');
            $table->boolean('inscricao_finalizada')->default(FALSE);
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
        Schema::dropIfExists('finaliza_inscricao');
    }
}