<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCotizacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('Cotizacion', function (Blueprint $table) {
          $table->increments('id');
          $table->string('nombre_cliente');
          $table->datetime('fecha_cotizacion');
          $table->datetime('fecha_expedicion');
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
        Schema::dropIfExists('Cotizacion');
    }
}
