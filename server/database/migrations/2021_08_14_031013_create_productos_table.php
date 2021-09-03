<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->boolean("visible");
            $table->boolean("estado");
            $table->unsignedBigInteger('tipo_producto_fk');
            $table->foreign('tipo_producto_fk')->references('id')->on('tipo_productos')->onDelete('cascade')->onUpdate('cascade');
            $table->string("nombre");
            $table->date("fecha_fabricacion");
            $table->date("fecha_vencimiento");
            $table->decimal("precio");
            $table->integer("cantidad");
            $table->string("descripcion");
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
        Schema::dropIfExists('productos');
    }
}
