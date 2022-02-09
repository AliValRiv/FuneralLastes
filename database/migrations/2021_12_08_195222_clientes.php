<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Clientes extends Migration
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
            $table->string('empleado',100);
            $table->string('paterno',255);
            $table->string('materno',255);
            $table->string('nombre',255);
            $table->char('genero');
            $table->date('fecha_nacimiento');
            $table->string('curp',18)->nullable();
            $table->string('rfc',13)->nullable();
            $table->string('nss',15)->nullable();
            $table->string('telefono',10)->nullable();
            $table->string('email',100)->nullable();
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->integer('empresa_id');
            $table->boolean('activo')->default(true);
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
