<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_ventas', function (Blueprint $table) {
            $table->id();
            $table->boolean("visible");
            $table->boolean("estado");
            $table->unsignedBigInteger('venta_fk');
            $table->foreign('venta_fk')->references('id')->on('ventas')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('producto_fk');
            $table->foreign('producto_fk')->references('id')->on('productos')->onDelete('cascade')->onUpdate('cascade');
            $table->integer("cantidad");
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
        Schema::dropIfExists('detalle_ventas');
    }
}
