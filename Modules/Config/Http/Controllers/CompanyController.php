<?php

namespace Modules\Config\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Config\Entities\Company;
use Modules\Config\Http\Controllers\BaseController;

class CompanyController extends BaseController
{
    protected $Company;

    public function __construct(Company $Company){
        $this->Company = $Company;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    
    public function index(Request $request)
    {
        $company = $this->Company->first();
        if($request->isMethod('post')){
            $params = $request->all();
            $params['created_id'] = $this->getAdmin()->id;
            if(empty($company)){
                $this->Company->create($params);
            }else{
                $company->fill($params);
                $company->save();
            }
            return $this->success('config.company.index');
        }
        $data['company'] = $company;
        return view('config::company.index', $data);
    }
}
