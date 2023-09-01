<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccionistasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accionistas', function (Blueprint $table) {
            $table->id();
            $table->integer('id_formulario');
            $table->string('nombre', 100);
            $table->tinyInteger('tipo_identificacion');
            $table->string('identificacion', 20);
            $table->string('digito_verificacion', 5);
            $table->double('capital');
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
        Schema::dropIfExists('accionistas');
    }
}
