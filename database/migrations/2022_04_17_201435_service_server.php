<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ServiceServer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_server', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code_server',999);
            $table->string('server_service',999);
            $table->string('rate_server', 999);
            $table->text('title_server')->nullable();
            $table->text('notice')->nullable();
            $table->string('server', 999)->nullable();
            $table->string('status_server', 999);
            $table->string('key_server', 999)->nullable();
            $table->string('reaction', 999)->nullable();
            $table->string('type_server', 999)->nullable();
            $table->string("api_server", 999)->nullable();
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
        Schema::dropIfExists('service_server');
    }
}
