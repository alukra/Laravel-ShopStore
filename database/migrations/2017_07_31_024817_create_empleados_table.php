<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpleadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('Empleado', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('usuario_id');
          $table->integer('municipio_id');
          $table->integer('imagen_id')->nullable();
          $table->string('dui');
          $table->string('nit');
          $table->string('afp');
          $table->string('direccion');
          $table->char('genero',1);
          $table->dateTime('fecha_nacimiento');
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
        Schema::dropIfExists('Empleado');
    }
}
