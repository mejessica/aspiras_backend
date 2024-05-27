<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHorasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('horas', function (Blueprint $table) {
            $table->id();
            $table->date('data');
            $table->string('entrada1');
            $table->string('saida1');
            $table->string('entrada2');
            $table->string('saida2');
            $table->unsignedBigInteger('configuration_id');
            $table->foreign('configuration_id')->references('id')->on('configurations');
            // ->constrained()
            // ->foreignId()
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
        Schema::dropIfExists('horas');
    }
}
