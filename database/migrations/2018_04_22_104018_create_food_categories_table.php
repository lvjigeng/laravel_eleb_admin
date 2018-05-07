<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFoodCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('food_categories', function (Blueprint $table) {
            $table->engine='innodb';
            $table->increments('id');
            $table->string('name');
            $table->string('description')->default('');
            $table->tinyInteger('is_selected')->default(0);
            $table->string('type_accumulation')->default('');
            $table->integer('shop_detail_id')->unsigned();
            $table->foreign('shop_detail_id')->references('id')->on('shop_details');
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
        Schema::dropIfExists('food_categories');
    }
}
