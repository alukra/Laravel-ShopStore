<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('Producto', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('tipo_id');
          $table->integer('garantia_id');
          $table->string('nombre');
          $table->string('sku')->nullable();
          $table->integer('stock');
          $table->double('precio');
          $table->double('precio_promocion');
          $table->boolean('liquidacion');
          $table->boolean('venta');
          $table->boolean('rated');
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
        Schema::dropIfExists('Producto');
    }
}
