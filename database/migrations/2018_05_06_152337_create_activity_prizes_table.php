<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivityPrizesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activity_prizes', function (Blueprint $table) {
            $table->engine='innodb';
            $table->increments('id');
            $table->integer('activity_id')->unsigned();
            $table->string('name');
            $table->string('description');
            $table->string('shopAccount_id')->default('');
            $table->foreign('activity_id')->references('id')->on('activities');
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
        Schema::dropIfExists('activity_prizes');
    }
}
