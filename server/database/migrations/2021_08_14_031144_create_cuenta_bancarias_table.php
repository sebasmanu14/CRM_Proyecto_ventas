<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCuentaBancariasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuenta_bancarias', function (Blueprint $table) {
            $table->id();
            $table->boolean("visible");
            $table->boolean("estado");
            $table->unsignedBigInteger('tipo_cuenta_bancaria_fk');
            $table->foreign('tipo_cuenta_bancaria_fk')->references('id')->on('tipo_cuenta_bancarias')->onDelete('cascade')->onUpdate('cascade');
            $table->string("numero_cuenta")->unique();
            $table->string("nombre_banco");
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
        Schema::dropIfExists('cuenta_bancarias');
    }
}
