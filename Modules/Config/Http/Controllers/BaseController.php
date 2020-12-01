<?php
/**
 * Created by PhpStorm.
 * User: hcenter
 * Date: 9/16/20
 * Time: 10:59
 */

namespace Modules\Config\Http\Controllers;
use Illuminate\Routing\Controller;
use Auth;

class BaseController extends Controller
{
    /**
     * @param $route
     * @param $param
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    protected function success($route, $param=null)
    {
        return redirect(route($route, $param))->with([
            'level'         => 'success',
            'message' => __('Thành công'),
        ]);
    }

    /**
     * @param $route
     * @param null $param
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    protected function error($route, $param=null)
    {
        return redirect(route($route, $param))->with([
            'level'         => 'error',
            'message' => __('Có lỗi xảy ra, vui lòng thử lại'),
        ]);
    }

    protected function getAdmin(){
        if(Auth::check()){
            return Auth::user();
        }
        return [];
    }
}