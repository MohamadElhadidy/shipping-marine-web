<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArrivalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('arrival', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('vessel_id')->index('vessel_id');
            $table->string('sn');
            $table->string('type');
            $table->string('room_no');
            $table->string('hla1');
            $table->string('hla2', 225);
            $table->string('seer');
            $table->string('kbsh');
            $table->string('crane');
            $table->string('ename');
            $table->string('notes');
            $table->string('move_id');
            $table->dateTime('date');
            $table->dateTime('update_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('arrival');
    }
}
