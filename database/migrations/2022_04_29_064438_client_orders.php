<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ClientOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username', 999);
            $table->string('type', 999);
            $table->string('soluong', 999);
            $table->string('time_order', 999)->nullable();
            $table->string('total_money', 999);
            $table->string('prices', 999);
            $table->string('link_order', 999);
            $table->string('server_order', 999);
            $table->string('reaction', 999)->nullable();
            $table->string('comment', 999)->nullable();
            $table->string('status', 999);
            $table->string('code_order', 999)->nullable();
            $table->string('id_order', 999)->nullable();
            $table->text('ghichu')->nullable();
            $table->string('type_service', 999)->nullable();
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
        Schema::dropIfExists('client_orders');
    }
}
