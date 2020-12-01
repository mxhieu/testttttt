<?php

namespace App\Http\Controllers\Cfg;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CfgCompanyController extends Controller
{
    public function index(){
        return view('component.cfg.company.index');
    }
}
