<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->engine='innodb';
            $table->increments('id');
            $table->string('order_code');
            $table->integer('order_birth_time');
            $table->tinyInteger('order_status');
            $table->integer('shop_id');
            $table->string('shop_name');
            $table->string('shop_img');
            $table->string('provence');
            $table->string('city');
            $table->string('area');
            $table->string('order_address');
            $table->string('name');
            $table->string('tel');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('orders');
    }
}
