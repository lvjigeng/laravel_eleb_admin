<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Menu extends Model
{
    //
    protected $fillable = [
        'name', 'parent_id', 'my_route', 'sort'
    ];

    static function menus()
    {
        $menus = self::where('parent_id', 0)->get();
        $res='';            //需要返回的字符串
        foreach ($menus as $menu) {
             $parent_menu="<li class='dropdown'>
                    <a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'>{$menu->name}<span class='caret'></span></a>
                    <ul class='dropdown-menu'>";

            $navs = self::where('parent_id', $menu->id)->get();
            $child_menu='';   //子级菜单
            foreach ($navs as $nav) {
                if (Auth::user()->hasPermission($nav->my_route)) //判断管理员是否有和这个权限

                    $child_menu .= '<li><a href="'.route($nav->my_route).'">'.$nav->name.'</a></li>';

                }
                    $str="</ul></li>";
                    if (!$child_menu){
                        continue;
                    }
                    $res.=$parent_menu.$child_menu.$str;

        }

        return $res;
    }
}
