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
            $table->unsignedBigInteger('atendente_id')->nullable()->after('id');

            // Se quiser criar a relação com a tabela users:
            $table->foreign('atendente_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('requerimentos', function (Blueprint $table) {
            $table->dropForeign(['atendente_id']);
            $table->dropColumn('atendente_id');
        });
    }
};
