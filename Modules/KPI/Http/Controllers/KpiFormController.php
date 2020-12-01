<?php

namespace Modules\KPI\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Modules\KPI\Entities\KpiForm;
use Modules\KPI\Http\Controllers\BaseController;
use Yajra\Datatables\Datatables;

class KpiFormController extends BaseController
{

    protected $KpiForm;
    
    public function __construct(){
        $this->KpiForm = new KpiForm();
    }

    public function datatables(){
        $list = $this->KpiForm->getAll();
        return Datatables::of($list)
        ->addColumn('action', function ($list) {
            return '<a href="'.route('kpi.form.edit', $list->id).'" class="btn btn-xs btn-warning">
                        <i class="fa fa-eye"></i> View</a>
                    <a href="javascript:void(0)" data-link="'.route('kpi.form.destroy', $list->id). '" class="btn btn-xs btn-danger btn-delete">
                        <i class="fa fa-times"></i> Delete</a>';
        })
        ->rawColumns(['action'])
        ->make(true);
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('kpi::form.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(Request $request)
    {
        return view('config::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $params = $request->all();
        $params['created_id'] = $this->getAdmin()->id;
        $params['code'] = $this->generateCode('KPI-FORM-');
        try{
            $this->KpiForm->create($params);
            return $this->success('kpi.form.index');
        }catch (\Exception $e) {
            return $this->error('kpi.form.index');
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $info = $this->KpiForm->findOrFail($id);
        $data['info'] = $info;
        return view('kpi::form.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $info = $this->KpiForm->findOrFail($id);
        if($request->isMethod('put')){
            try{
                $params = $request->all();
                $params['updated_id'] = $this->getAdmin()->id;
                $info->fill($params);
                $info->save();
                return $this->success('kpi.form.index');
            }catch (\Exception $e) {
                return $this->error('kpi.form.index');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        try{
            $info = $this->KpiForm->findOrFail($id);
            $info->delete();
            return ['status' => true, 'msg' => 'xóa thành công "' .$info->name.'"', 'data' => []];
        }catch (\Exception $e) {
            return ['status' => false, 'msg' => 'Có lỗi xảy ra vui lòng thực hiện lại', 'data' => []];
        }
    }
}

