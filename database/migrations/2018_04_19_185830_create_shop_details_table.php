<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop_details', function (Blueprint $table) {
            $table->engine='innodb';
            $table->increments('id');
            $table->string('shop_name')->unique();   //"上沙麦当劳",
            $table->string('shop_img')->default(''); //店铺logo
            $table->float('shop_rating')->default(0);//店铺评分
            $table->float('service_rating')->default(0);//服务评分
            $table->float('foods_rating')->default(0);//食物评分
            $table->tinyInteger('high_or_low')->default(0);//true, 低于还是高于周边商家
            $table->tinyInteger('h_l_percent')->default(0);//30,// 低于还是高于周边商家的百分比
            $table->tinyInteger('brand')->default(0);//是否是品牌
            $table->tinyInteger('on_time')->default(0);//是否是准时到达
            $table->tinyInteger('fengniao')->default(0);//是否是蜂鸟配送
            $table->tinyInteger('bao')->default(0);//是否保标记
            $table->tinyInteger('zhun')->default(0);//是否准标记
            $table->decimal('start_send')->default(0);//20,起送金额
            $table->decimal('send_cost')->default(0);//5,配送费
            $table->string('notice')->default('');//店公告
            $table->string('discount')->default('');//优惠信息
            $table->integer('shop_category_id')->default(0);//分类
//            $table->foreign('shop_category_id')->references('id')->on('shop_categories');
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
        Schema::dropIfExists('shop_details');
    }
}
