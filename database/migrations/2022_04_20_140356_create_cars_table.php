<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('vessel_id')->index('vessel_id');
            $table->string('sn');
            $table->string('car_no');
            $table->string('car_type');
            $table->string('car_owner');
            $table->string('mehwer')->nullable();
            $table->string('vacant')->nullable();
            $table->string('limits')->nullable();
            $table->string('cost_type', 225)->nullable();
            $table->string('wait_hours', 225)->nullable();
            $table->string('all_hours')->nullable();
            $table->string('moves')->nullable();
            $table->string('qnt')->nullable();
            $table->string('cost')->nullable();
            $table->double('wait_cost')->nullable();
            $table->double('wait')->nullable();
            $table->string('all_cost', 225)->nullable();
            $table->string('done')->default('0');
            $table->dateTime('start_date')->nullable();
            $table->dateTime('exit_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cars');
    }
}
