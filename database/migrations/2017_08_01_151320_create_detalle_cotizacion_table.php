<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetalleCotizacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('Detalle_cotizacion', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('cotizacion_id');
          $table->integer('producto_id');
          $table->integer('cantidad');
          $table->double('precio');
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
