<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoadingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loading', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('vessel_id')->index('vessel_id');
            $table->string('sn');
            $table->string('type');
            $table->string('store_no');
            $table->string('qnt');
            $table->string('jumbo');
            $table->string('ename');
            $table->string('notes');
            $table->string('move_id');
            $table->dateTime('date');
            $table->dateTime('qnt_date')->nullable();
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
        Schema::dropIfExists('loading');
    }
}
