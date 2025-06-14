<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('movimentacoes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('requerimento_id');
            $table->unsignedBigInteger('setor_origem_id')->nullable();
            $table->unsignedBigInteger('setor_destino_id');
            $table->unsignedBigInteger('situacao_movimentacao_id');
            $table->unsignedBigInteger('enviado_por');
            $table->unsignedBigInteger('recebido_por')->nullable();
            $table->timestamp('data_hora_enviado')->nullable();
            $table->timestamp('data_hora_recebido')->nullable();
            $table->string('status')->default('Enviado');
            $table->timestamps();

            $table->foreign('requerimento_id')->references('id')->on('requerimentos');
            $table->foreign('situacao_movimentacao_id')->references('id')->on('situacao_movimentacao');
            $table->foreign('setor_origem_id')->references('id')->on('setor');
            $table->foreign('setor_destino_id')->references('id')->on('setor');;
            $table->foreign('enviado_por')->references('id')->on('users');
            $table->foreign('recebido_por')->references('id')->on('users');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movimentacao');
    }
};
