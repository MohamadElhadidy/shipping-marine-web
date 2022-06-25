<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToCarsExitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cars_exit', function (Blueprint $table) {
            $table->foreign(['vessel_id'], 'cars_exit_ibfk_1')->references(['vessel_id'])->on('vessels_log')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cars_exit', function (Blueprint $table) {
            $table->dropForeign('cars_exit_ibfk_1');
        });
    }
}
