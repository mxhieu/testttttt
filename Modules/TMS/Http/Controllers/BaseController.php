<?php

namespace Modules\TMS\Http\Controllers;

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
     * Upload image
     * @param  Request $Request [description]
     * @param  [type]  $file    [description]
     * @return [type]           [description]
     */
    protected function uploadFile($Request, $file, $saveAt){
        if($Request->hasFile($file))
        {
            $image = $Request->file($file);
        }
        else{
            $image = $file; 
        }
        $new_name = $this->generateRandomString(10).'.'.$image->getClientOriginalExtension();
        //Create a folder if it doesn't already exist
        if (!is_dir(public_path().'/upload/'. $saveAt)) {
            mkdir(public_path().'/upload/'. $saveAt, 0777, true);
        }
        $image->storeAs('/upload/'. $saveAt, $new_name, 'upload_file');
        return $new_name;
    }

    /**
     * multi upload file
     *
     * @param [type] $request
     * @param [type] $file
     * @param [type] $saveAt
     * @return void
     */
    protected function multiUploadFile($request, $file, $saveAt){
        if($request->hasFile($file)) {
            $file = $request->File($file);
            $listName = [];
            foreach($file as $image){
                $imageName = rand(1,999999).'-'.$image->getClientOriginalName();
                if (!is_dir(public_path().'/upload/'. $saveAt)) {
                    mkdir(public_path().'/upload/'. $saveAt, 0777, true);
                }
                $image->storeAs('/upload/'. $saveAt, $imageName, 'upload_file');
                $listName[] = $imageName;
            }
            return json_encode($listName);
        }
        return null;
    }

    /**
     * Delete Image in folder
     * @param string $PathOldImage path to image
     */
    public function DeleteImageInFolder($Image, $Folder){
        if(!empty($Image))
        {
            $PathOldImage = public_path('upload/'.$Folder.'/'.$Image);
            if(file_exists($PathOldImage))
            {
                unlink($PathOldImage);
            }
        }
    }

    /**
     * check file upload, if file isn't exists, it will add new file
     * else if file is exists, it will changeless
     *
     * @param   array   $Request  requesr form user
     * @param   string  $file     file name
     * @param   string  $field    form field
     * @param   string  $folder   The directory containing the file
     *
     * @return  string            file name
     */
    public function CheckUpdateField($Request, $file, $field, $folder){
        $fileName = $file;
        if($Request->hasFile($field))
        {
            if(is_array($Request->$field)){
                $fileName = $this->multiUploadFile($Request, $field, $folder);
                $oldImages = json_decode($file, true);
                if(!empty($oldImages)){
                    foreach($oldImages as $row){
                        $this->DeleteImageInFolder($row, $folder);
                    }
                }
            }else{
                if(!empty($file)){
                    $this->DeleteImageInFolder($file, $folder);
                }
                $fileName = $this->uploadFile($Request, $field, $folder);
            }
        }
        return $fileName;
    }

    /**
     * @param $fileName
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     * @created 2019/05/15 HieuMX
     */
    public function downloadFile($folder, $fileName)
    {
        // get file path
        $path = public_path("upload") . '/' . $folder . '/' . $fileName;

        // process downloading file
        if (!file_exists($path)) {
            abort(404);
        } else
            return response()->download($path);
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