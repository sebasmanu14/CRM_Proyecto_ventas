<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->boolean("visible");
            $table->boolean("estado");
            $table->unsignedBigInteger('rol_fk');
            $table->foreign('rol_fk')->references('id')->on('rols')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('cuenta_bancaria_fk')->unique()->nullable();
            $table->foreign('cuenta_bancaria_fk')->references('id')->on('cuenta_bancarias')->onDelete('cascade')->onUpdate('cascade');
            $table->string("nombres");
            $table->string("apellidos");
            $table->string("correo")->unique();
            $table->string("clave");
            $table->string("numero_identificacion")->unique();
            $table->string("numero_telefono");
            $table->string("direccion");
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
        Schema::dropIfExists('clientes');
    }
}
