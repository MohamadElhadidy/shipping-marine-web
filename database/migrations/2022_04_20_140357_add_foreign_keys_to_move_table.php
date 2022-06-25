<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToMoveTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('move', function (Blueprint $table) {
            $table->foreign(['vessel_id'], 'move_ibfk_1')->references(['vessel_id'])->on('vessels_log')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('move', function (Blueprint $table) {
            $table->dropForeign('move_ibfk_1');
        });
    }
}
