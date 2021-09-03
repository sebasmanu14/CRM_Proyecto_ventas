<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventas', function (Blueprint $table) {
            $table->id();
            $table->boolean("visible");
            $table->boolean("estado");
            $table->unsignedBigInteger('cliente_fk');
            $table->foreign('cliente_fk')->references('id')->on('clientes')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('tipo_pago_fk');
            $table->foreign('tipo_pago_fk')->references('id')->on('tipo_pagos')->onDelete('cascade')->onUpdate('cascade');
            $table->decimal("total");
            $table->decimal("iva");
            $table->decimal("descuento");
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
        Schema::dropIfExists('ventas');
    }
}
