<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('name');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->integer('type')->default(2)->index();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('notification_preference')->nullable();
            $table->rememberToken();
            $table->string('hint', 225)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
