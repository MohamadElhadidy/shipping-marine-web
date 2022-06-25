<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToStopTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stop', function (Blueprint $table) {
            $table->foreign(['vessel_id'], 'stop_ibfk_1')->references(['vessel_id'])->on('vessels_log')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stop', function (Blueprint $table) {
            $table->dropForeign('stop_ibfk_1');
        });
    }
}
