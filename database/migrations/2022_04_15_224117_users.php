<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Users extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id', 50);
            $table->string('name', 999);
            $table->string('email', 999);
            $table->string('username', 999);
            $table->string('password', 999);
            $table->string('api_token', 999);
            $table->string('role', 999);
            $table->string('total_money', 999);
            $table->string('total_charge', 999);
            $table->string('total_minus', 999);
            $table->string('banned', 999)->nullable();
            $table->string('time_banned', 999)->nullable();
            $table->string('ip', 999);
            $table->string('transfer_code')->nullable();
            $table->rememberToken();
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
