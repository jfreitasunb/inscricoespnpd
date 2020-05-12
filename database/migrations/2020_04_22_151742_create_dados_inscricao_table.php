<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDadosInscricaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dados_inscricao', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('id_candidato');
            $table->foreign('id_candidato')->references('usuario_id')->on('users')->onDelete('cascade');
            $table->unsignedInteger('id_inscricao_pnpd');
            $table->foreign('id_inscricao_pnpd')->references('usuario_id')->on('users')->onDelete('cascade');
            $table->string('cpf', 20);
            $table->text('instituicao');
            $table->integer('ano_doutorado', false, false);
            $table->text('colaboradores');
            $table->string('recomendantes', 26);
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
        Schema::dropIfExists('dados_inscricao');
    }
}
