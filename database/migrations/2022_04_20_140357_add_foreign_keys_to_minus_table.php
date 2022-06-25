<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToMinusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('minus', function (Blueprint $table) {
            $table->foreign(['vessel_id'], 'minus_ibfk_1')->references(['vessel_id'])->on('vessels_log')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('minus', function (Blueprint $table) {
            $table->dropForeign('minus_ibfk_1');
        });
    }
}
