<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('movimentacao', function (Blueprint $table) {
            $table->id();

            $table->foreignId('setor_origem_id')->constrained('setor');
            $table->foreignId('setor_destino_id')->constrained('setor');

            $table->foreignId('enviado_por')->constrained('users');
            $table->foreignId('recebido_por')->nullable()->constrained('users');

            $table->dateTime('data_hora_enviado');
            $table->dateTime('data_hora_recebido')->nullable();

            $table->foreignId('situacao_id')->constrained('situacao_movimentacao');

            $table->timestamps();
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
