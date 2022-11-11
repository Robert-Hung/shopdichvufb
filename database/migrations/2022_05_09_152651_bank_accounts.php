<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BankAccounts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type', 999)->nullable();
            $table->string('name', 999);
            $table->string('number', 999);
            $table->string('password', 999)->nullable();
            $table->string('logo', 999)->nullable();
            $table->string('min_bank', 999)->nullable();
            $table->string('notice', 999)->nullable();
            $table->string('token', 999)->nullable();
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
        Schema::dropIfExists('bank_accounts');
    }
}
