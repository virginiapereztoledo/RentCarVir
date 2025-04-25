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
        Schema::create('vehiculo', function (Blueprint $table) {
            $table->id();
            $table->char('matricula', 7)->unique();
            $table->string('modelo', 100);
            $table->string('marca', 30);
            $table->string('motor', 20);
            $table->string('cambio', 20);
            $table->string('equipamiento', 100);
            $table->string('puertas', 10);
            $table->char('asientos', 1);
            $table->decimal('autonomia');
            $table->string("color", 30);
            $table->string("foto")->nullable();
            $table->text("descripcion")->nullable();
            $table->date("emision");
            $table->date("vencimiento");
            $table->decimal("costoDiario", 6);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehiculo');
    }
};
