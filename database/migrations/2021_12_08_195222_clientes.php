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
            $table->string('materno',255)->nullable();
            $table->string('nombre',255);
            $table->char('genero')->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_fin')->nullable();
            $table->string('curp',18)->nullable();
            $table->string('rfc',13)->nullable();
            $table->string('nss',15)->nullable();
            $table->string('telefono',10)->nullable();
            $table->string('email',100)->nullable();
            $table->string('opc1',255)->nullable();
            $table->string('opc2',255)->nullable();
            $table->string('opc3',255)->nullable();
            $table->string('opc4',255)->nullable();
            $table->string('opc5',255)->nullable();
            $table->string('opc6',255)->nullable();
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
