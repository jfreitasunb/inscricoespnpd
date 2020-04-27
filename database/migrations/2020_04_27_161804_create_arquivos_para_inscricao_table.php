<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArquivosParaInscricaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('arquivos_para_inscricao', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('id_candidato');
            $table->foreign('id_candidato')->references('usuario_id')->on('users')->onDelete('cascade');
            $table->unsignedInteger('id_inscricao_pnpd');
            $table->foreign('id_inscricao_pnpd')->references('usuario_id')->on('users')->onDelete('cascade');
            $table->string('nome_arquivo', 255);
            $table->string('tipo_arquivo', 50);
            $table->boolean('removido')->default(FALSE);
            $table->timestamp('data_remocao');
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
        Schema::dropIfExists('arquivos_para_inscricaos');
    }
}
