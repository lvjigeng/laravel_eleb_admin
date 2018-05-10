<?php

namespace App\Http\Controllers;

use App\Model\ShopAccount;
use App\Model\ShopCategory;
use App\Model\ShopDetail;
use App\SphinxClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class ShopAccountController extends Controller
{
    //没登录什么都做不了
    public function __construct()
    {
        $this->middleware('auth',[

        ]);
    }
    //店铺列表
    public function index(Request $request)
    {

        //实例化分词搜索的类
        if ($request->keywords!=''){
            $cl = new SphinxClient();
            $cl->SetServer ( '127.0.0.1', 9312);
//$cl->SetServer ( '10.6.0.6', 9312);
//$cl->SetServer ( '10.6.0.22', 9312);
//$cl->SetServer ( '10.8.8.2', 9312);
            $cl->SetConnectTimeout ( 10 );
            $cl->SetArrayResult ( true );
// $cl->SetMatchMode ( SPH_MATCH_ANY);
            $cl->SetMatchMode ( SPH_MATCH_EXTENDED2);
            $cl->SetLimits(0, 1000);
            $info = $request->keywords;
            $res = $cl->Query($info, 'shops');//shopstore_search
//            dd($res);
           if ($res['total']){
               $datas=collect($res['matches'])->pluck('id')->toArray();

               $shopAccounts=ShopAccount::whereIn('shop_detail_id',$datas)->get();

           }else{
               session()->flash('danger','没有搜索到相关店铺,请换个词搜索');
               return back();
           }

        }else{
            $shopAccounts=ShopAccount::all();
        }
        return view('shopAccount/index',compact('shopAccounts'));

    }
    //店铺详情
    public function show(ShopAccount $shopAccount)
    {
        $shopCategories=ShopCategory::all();
        return view('shopAccount/show',compact('shopAccount','shopCategories'));
    }
    //添加店铺
    public function create()
    {
        $shopCategories=ShopCategory::all();
        return view('shopAccount/create',compact('shopCategories'));
    }
    //保存
    public function store(Request $request)
    {

        //验证
        $this->validate($request, [
            'name' => 'required|regex:/^1[34578][0-9]{9}$/
',
            'email'=>'required|regex:/\w+([-+.\']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/|unique:shop_accounts',
            'password' => 'required|confirmed|min:6',
            'shop_name' => 'required|unique:shop_details',
            'start_send' => 'required',
            'send_cost' => 'required',
            'shop_img' => 'required',


        ], [
            'name.required' => '手机号不能为空',
            'name.regex' => '请输入正确的手机号',
            'email.required'=>'邮箱不能为空',
            'email.regex'=>'邮箱格式不正确',
            'email.unique'=>'邮箱已存在',
            'password.required' => '密码不能为空',
            'password.min' => '密码最小6位',
            'password.confirmed' => '两次密码不一致',
            'shop_name.required' => '店铺名字不能为空',
            'shop_name.unique' => '店铺名字已存在',
            'start_send.required' => '起送金额不能为空',
            'send_cost.required' => '配送金额不能为空',
            'shop_img.required' => '商家图片不能为空',

        ]);
        //保存图片
        //保存
        DB::transaction(function () use ($request) {

            $ShopDetail = ShopDetail::create([
                'shop_name' => $request->shop_name,
                'start_send' => $request->start_send,
                'send_cost' => $request->send_cost,
                'send_cost' => $request->send_cost,
                'notice' => $request->notice,
                'discount' => $request->discount,
                'shop_img' => $request->shop_img,
            ]);

            ShopAccount::create([
                'name' => $request->name,
                'email'=>$request->email,
                'password' => bcrypt($request->password),
                'status'=>1,
                'shop_detail_id' => $ShopDetail->id,
            ]);


        });

        session()->flash('success', '注册成功账号,请等待审核');
        return redirect()->route('shopAccount');
    }
    //审核通过
    public function pass(ShopAccount $shopAccount)
    {
        $shopAccount->where('id',$shopAccount->id)
            ->update([
            'status'=>1
        ]);
        //审核通过给他发送邮件
        Mail::send('shopAccount/pass',['name'=>$shopAccount->name],function ($message) use ($shopAccount){
            $message->to($shopAccount->email)->subject('店铺审核通过');
        });
        session()->flash('success','店铺通过审核,发送邮件成功');
        return redirect()->route('shopAccount');


    }
    //禁用账号
    public function disabled(ShopAccount $shopAccount)
    {
        $shopAccount
            ->where('id',$shopAccount->id)
            ->update([
                'status'=>0
        ]);

        //禁用账号给他发送邮件
        Mail::send('shopAccount/disable',['name'=>$shopAccount->name],function ($message) use ($shopAccount){
            $message->to($shopAccount->email)->subject('店铺账号禁用');
        });
        session()->flash('success','店铺账号禁用,发送邮件成功');
        return redirect()->route('shopAccount');
    }
}
