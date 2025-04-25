<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('usuario', function (Blueprint $table) {
            $table->id();
            $table->string('username', 30)->unique();
            $table->string('password');
            $table->unsignedBigInteger('utenteable_id')->nullable();
            $table->string('utenteable_type', 25);
            $table->rememberToken();
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuario');
    }
};
