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
        Schema::create('notas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cliente_id');
            $table->unsignedBigInteger('oportunidad_id');
            $table->text('contenido');
            $table->unsignedBigInteger('usuario_id');
            $table->dateTime('fecha_hora');
            $table->timestamps();
    
            $table->foreign('cliente_id')->references('id')->on('clientes');
            $table->foreign('oportunidad_id')->references('id')->on('oportunidades');
            $table->foreign('usuario_id')->references('id')->on('usuarios');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notas');
    }
};
