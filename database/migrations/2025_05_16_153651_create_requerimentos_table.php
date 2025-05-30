<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('requerimentos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->string('matricula');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('course_id');
            $table->string('tipo_requerimento');
            $table->text('descricao');
            $table->string('anexo')->nullable();
            $table->string('status')->default('Pendente');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('requerimentos');
    }
};
