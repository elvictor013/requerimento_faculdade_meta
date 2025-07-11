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
        Schema::table('requerimentos', function (Blueprint $table) {
            $table->string('anexo_resposta_atendente')->nullable();
        });
    }

    public function down()
    {
        Schema::table('requerimentos', function (Blueprint $table) {
            $table->dropColumn('anexo_resposta_atendente');
        });
    }
};
