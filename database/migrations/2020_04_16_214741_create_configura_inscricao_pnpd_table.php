<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfiguraInscricaoPNPDTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configura_inscricao_pnpd', function (Blueprint $table) {
            $table->bigIncrements('id_inscricao_pnpd');
            $table->unsignedInteger('id_usuario_configurou');
            $table->foreign('id_usuario_configurou')->references('usuario_id')->on('users')->onDelete('cascade');
            $table->date('inicio_inscricao');
            $table->date('fim_inscricao');
            $table->date('prazo_carta');
            $table->date('data_homologacao');
            $table->date('data_divulgacao_resultado');
            $table->boolean('necessita_recomendante')->default(True);
            $table->integer('numero_cartas')->default(2);
            $table->string('edital', 7);
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
        Schema::dropIfExists('configura_inscricao_pnpd');
    }
}
