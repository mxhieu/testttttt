<?php

namespace Modules\EVENT\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Auth;
use DateTime;

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

    /**
     * @return string
     * @throws \Exception
     */
    public function generateCode($prefixCode)
    {
        $random = random_int(001, 999);
        $code = $prefixCode . sprintf("%s%'.03d", date('ymd'), $random);
        $random = random_int(001, 999);
        return $code;
    }

    protected function getAdmin(){
        if(Auth::check()){
            return Auth::user();
        }
        return [];
    }

    /**
     * generate random number 
     *
     * @param   [interger]  $length  length of return string
     *
     * @return  [string]             random string
     */
    function generateRandomString($length = 10) {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function formatTime($time){
        $format = "d/m/Y H:i:s";
        $timestamp = DateTime::createFromFormat($format, $time)->getTimestamp();
        return date('Y/m/d H:i:s', $timestamp);
    }
}
