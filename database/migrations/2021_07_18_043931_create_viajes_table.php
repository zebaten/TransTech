<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateViajesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('viajes', function (Blueprint $table) {
            $table->id();
            $table->string('usuarios_rut');
            $table->integer('camion_id');
            $table->date('viaje_inicio');
            $table->string('viaje_lugar_inicio');
            $table->string('viaje_destino');
            $table->date('viaje_fecha');
            $table->integer('comuna_inicio_cod');
            $table->integer('comuna_cod');
            $table->integer('lic_cod');
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
        Schema::dropIfExists('viajes');
    }
}
