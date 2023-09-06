<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('usuarios_rut');
            $table->string('password');
            $table->string('usuarios_nombre');
            $table->integer('usuarios_telefono');
            $table->string('usuarios_correo')->unique();
            $table->string('usuarios_direccion');
            $table->date('usuarios_fncto');
            $table->string('usuarios_vacuna');
            $table->unsignedBigInteger('comuna_cod');
            $table->unsignedBigInteger('rol_cod');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuarios');
    }
}
