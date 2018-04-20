<?php

namespace App\Http\Controllers;

use App\Model\ShopAccount;
use App\Model\ShopCategory;
use Illuminate\Http\Request;

class ShopAccountController extends Controller
{
    //
    public function index()
    {
        $shopAccounts=ShopAccount::all();
        return view('shopAccount/index',compact('shopAccounts'));
    }
    //店铺详情
    public function show(ShopAccount $shopAccount)
    {
        $shopCategories=ShopCategory::all();
        return view('shopAccount/show',compact('shopAccount','shopCategories'));
    }
    //审核通过
    public function pass(ShopAccount $shopAccount)
    {
        $shopAccount->where('id',$shopAccount->id)
            ->update([
            'status'=>1
        ]);
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
        return redirect()->route('shopAccount');
    }
}
