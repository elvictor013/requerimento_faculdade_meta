<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('requerimentos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('aluno_id'); // Cria a coluna
            $table->string('tipo_requerimento');
            $table->text('descricao');
            $table->string('anexo')->nullable();
            $table->string('status')->default('Pendente');
            $table->string('protocolo')->unique()->nullable();
            $table->timestamps();

            // Chave estrangeira apontando para alunos
            $table->foreign('aluno_id')->references('id')->on('aluno')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('requerimentos');
    }
};
