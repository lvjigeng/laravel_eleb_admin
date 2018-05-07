<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
/*name 吮指原味鸡
rating    评分
price  价格
description
month_sales  月销售
rating_count  评分总数
tips      描述
satisfy_count  满意评分
satisfy_rate   好评率
goods_img    食物图片
food_category_id 外键*/
    public function up()
    {
        Schema::create('foods', function (Blueprint $table) {
            $table->engine='innodb';
            $table->increments('id');
            $table->string('name');
            $table->float('rating')->default(0);
            $table->decimal('price');
            $table->string('description')->default('');
            $table->integer('month_sales')->default(0);
            $table->float('rating_count')->default(0);
            $table->string('tips');
            $table->float('satisfy_count')->default(0);
            $table->float('satisfy_rate')->default(0);
            $table->string('food_img');
            $table->integer('food_category_id')->unsigned();
            $table->foreign('food_category_id')->references('id')->on('food_categories');
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
        Schema::dropIfExists('foods');
    }
}
