<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoveTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('move', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('vessel_id')->index('vessel_id');
            $table->string('sn')->index('sn');
            $table->string('loading')->default('0');
            $table->string('arrival')->default('0');
            $table->string('move_id');
            $table->string('qnt')->nullable()->default('0');
            $table->string('type');
            $table->string('jumbo');
            $table->string('store_no')->nullable();
            $table->string('room_no')->nullable();
            $table->string('hla1')->nullable();
            $table->string('hla2')->nullable();
            $table->string('seer')->nullable();
            $table->string('kbsh')->nullable();
            $table->string('crane')->nullable();
            $table->dateTime('load_date')->nullable();
            $table->dateTime('arrival_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('move');
    }
}
