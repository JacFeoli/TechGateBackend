<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRepresentantesEsalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('representantes_esal', function (Blueprint $table) {
            $table->id();
            $table->integer('id_formulario');
            $table->tinyInteger('tipo_relacion');
            $table->string('nombre', 100);
            $table->tinyInteger('tipo_identificacion');
            $table->string('identificacion', 20);
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
        Schema::dropIfExists('representantes_esal');
    }
}
