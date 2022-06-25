<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarsExitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars_exit', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('vessel_id')->index('cars_exit_ibfk_1');
            $table->string('sn');
            $table->string('cause');
            $table->string('ename');
            $table->dateTime('date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cars_exit');
    }
}
