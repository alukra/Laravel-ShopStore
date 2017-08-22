<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUbicacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Ubicacion', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->double('coord_x');
            $table->double('coord_y');
            $table->integer('imagen_id');
            $table->timestamps();
            $table->softDeletes();
        });
      }

      /**
       * Reverse the migrations.
       *
       * @return void
       */
      public function down()
      {
          Schema::dropIfExists('Ubicacion');
      }
}
