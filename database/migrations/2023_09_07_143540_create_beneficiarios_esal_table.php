<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBeneficiariosEsalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beneficiarios_esal', function (Blueprint $table) {
            $table->id();
            $table->integer('id_formulario');
            $table->tinyInteger('banco');
            $table->tinyInteger('tipo_cuenta');
            $table->string('numero_cuenta', 20);
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
        Schema::dropIfExists('beneficiarios_esal');
    }
}
