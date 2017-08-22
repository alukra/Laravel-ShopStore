<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
         Schema::create('Cliente', function (Blueprint $table) {
             $table->increments('id');
             $table->integer('usuario_id');
             $table->string('direccion')->nullable();
             $table->char('genero',1)->nullable();
             $table->dateTime('fecha_nacimiento')->nullable();
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
         Schema::dropIfExists('Cliente');
     }
 }
