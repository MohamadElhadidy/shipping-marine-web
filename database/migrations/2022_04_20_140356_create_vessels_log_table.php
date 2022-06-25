<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVesselsLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vessels_log', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('img_id')->nullable();
            $table->string('name');
            $table->integer('vessel_id')->unique('vessel_id');
            $table->string('qnt');
            $table->string('type');
            $table->string('client');
            $table->string('phones');
            $table->string('shipping_agency');
            $table->string('quay');
            $table->string('vessel_type', 225)->default('shipping');
            $table->string('notes');
            $table->string('done')->default('0');
            $table->string('archive', 225)->default('1');
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->dateTime('update_date')->nullable();
            $table->timestamp('updated_at');
            $table->timestamp('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vessels_log');
    }
}
