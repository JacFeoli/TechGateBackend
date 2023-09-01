<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJuntaDirectivaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('junta_directiva', function (Blueprint $table) {
            $table->id();
            $table->integer('id_formulario');
            $table->string('nombre', 100);
            $table->tinyInteger('tipo_identificacion');
            $table->string('identificacion', 20);
            $table->string('digito_verificacion', 5);
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
        Schema::dropIfExists('junta_directiva');
    }
}
