<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLicitacionsTable extends Migration
{
    
     /* Run the migrations.
     *
      @return void
     */
    
    public function up()
    {
        Schema::create('licitacions', function (Blueprint $table) {
            $table->id();
            $table->string('lic_nombre');
            $table->integer('lic_valor');
            $table->string('lic_empresa');
            $table->string('lic_rut');
            $table->timestamps();
        });
    }

    /*
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('licitacions');
    }
}