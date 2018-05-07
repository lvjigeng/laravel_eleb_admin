<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CountController extends Controller
{
    //订单统计
    public function orderIndex()
    {
        $time = date('Y-m-d');
        $date = $_GET['date']??$time;

        $orderTotal = DB::select("select sd.shop_name,count(od.id) as total
  from shop_details as sd 
  join orders as od on od.shop_id=sd.id 
  where od.order_status!=2
  group by od.shop_id 
  order by total desc 
  limit 3");

        //本月订单
        $orderMonth =DB::select("select sd.shop_name,count(od.id) as total
  from shop_details as sd 
  join orders as od on od.shop_id=sd.id 
  where od.created_at like ? and od.order_status!=2
  group by od.shop_id 
  order by total desc 
  limit 3",[date('Y-m', strtotime($date)) . '%']);

        //一天的订单
        $orderDay = DB::select("select sd.shop_name,count(od.id) as total
  from shop_details as sd 
  join orders as od on od.shop_id=sd.id 
  where od.created_at like ? and od.order_status!=2
  group by od.shop_id 
  order by total desc 
  limit 3",[date('Y-m-d', strtotime($date)) . '%']);

        return view('count/orderIndex',compact('orderTotal','orderMonth','orderDay','date'));
    }
    //菜品排行统计
    public function foodsIndex()
    {
        $time = date('Y-m-d');
        $date = $_GET['date']??$time;
        $month=substr($date,0,7);
        //总排行
        $foodsTotal=DB::table('orders_goods')
            ->join('orders','orders.id','=','orders_goods.order_id')
            ->join('shop_details','shop_details.id','=','orders.shop_id')
            ->select('shop_details.shop_name','orders_goods.goods_name',DB::raw('sum(orders_goods.amount) as total'))
            ->where('orders.order_status','<>',2)
            ->groupBy('orders_goods.goods_id')
            ->orderBy('total','desc')
            ->limit(3)
            ->get();

        //月排行

        $foodsMonth=DB::table('orders_goods')
            ->join('orders','orders.id','=','orders_goods.order_id')
            ->join('shop_details','shop_details.id','=','orders.shop_id')
            ->select('shop_details.shop_name','orders_goods.goods_name',DB::raw('sum(orders_goods.amount) as total'))
            ->where([
                ['orders_goods.created_at','like',"$month%"],
                ['orders.order_status','<>',2]
            ])
            ->groupBy('orders_goods.goods_id')
            ->orderBy('total','desc')
            ->limit(3)
            ->get();

        //日排行
        $foodsDay=DB::table('orders_goods')
            ->join('orders','orders.id','=','orders_goods.order_id')
            ->join('shop_details','shop_details.id','=','orders.shop_id')
            ->select('shop_details.shop_name','orders_goods.goods_name',DB::raw('sum(orders_goods.amount) as total'))
            ->where([
                ['orders_goods.created_at','like',"$date%"],
                ['orders.order_status','<>',2]
            ])
            ->groupBy('orders_goods.goods_id')
            ->orderBy('total','desc')
            ->limit(3)
            ->get();


        return view('count/foodsIndex',compact('foodsTotal','foodsMonth','foodsDay','date'));

    }


}
