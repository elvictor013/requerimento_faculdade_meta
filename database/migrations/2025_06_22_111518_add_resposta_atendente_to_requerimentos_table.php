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
        Schema::table('requerimentos', function (Blueprint $table) {
            $table->text('resposta_atendente')->nullable()->after('descricao');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('requerimentos', function (Blueprint $table) {
            //
        });
    }
};
