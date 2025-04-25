<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void{
        Schema::create('alquiler', function (Blueprint $table) {
            $table->id();
            $table->date("fechaRecogida");
            $table->string("lugarRecogida", 100);
            $table->string("horaRecogida", 5);
            $table->date("fechaEntrega");
            $table->string("lugarEntrega", 100);
            $table->string("horaEntrega", 5);
            $table->decimal("importe", 9);
            $table->boolean("activo");
            $table->unsignedBigInteger("clienteID" );
            $table->foreign('clienteID')->references('id')->on('cliente')->onDelete('cascade');
            $table->unsignedBigInteger("vehiculoID");
            $table->foreign('vehiculoID')->references('id')->on('vehiculo')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alquiler');
    }
};
