<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMinusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('minus', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('vessel_id')->index('vessel_id');
            $table->string('sn')->index('sn');
            $table->string('cause');
            $table->string('ename');
            $table->time('minus_duration');
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
        Schema::dropIfExists('minus');
    }
}
