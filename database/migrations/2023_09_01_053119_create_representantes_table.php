<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRepresentantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('representantes', function (Blueprint $table) {
            $table->id();
            $table->integer('id_formulario');
            $table->tinyInteger('tipo_rol');
            $table->string('nombre', 100);
            $table->tinyInteger('tipo_identificacion');
            $table->string('identificacion', 20);
            $table->string('digito_verificacion', 5);
            $table->double('capital');
            $table->tinyInteger('pep');
            $table->string('tipo_relacion_pep', 100);
            $table->string('identificacion_pep', 20);
            $table->text('declaracion_veracidad_pep');
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
        Schema::dropIfExists('representantes');
    }
}
