<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class HistoryBank extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history_bank', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type', 999);
            $table->string('username', 999);
            $table->string('card_type', 999)->nullable();
            $table->string('card_price', 999)->nullable();
            $table->string('serial', 999)->nullable();
            $table->string('code', 999)->nullable();
            $table->string('thucnhan', 999)->nullable();
            $table->string('status', 999)->nullable();
            $table->string('date', 999)->nullable();
            $table->string('name', 999)->nullable();
            $table->string('tranid', 999)->nullable();
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
        Schema::dropIfExists('history_bank');
    }
}
