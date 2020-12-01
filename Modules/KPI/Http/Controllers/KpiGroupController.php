<?php

namespace Modules\KPI\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\KPI\Entities\KpiGroup;
use Modules\KPI\Http\Controllers\BaseController;
use Yajra\Datatables\Datatables;

class KpiGroupController extends BaseController
{

    protected $KpiGroup;
    
    public function __construct(){
        $this->KpiGroup = new KpiGroup();
    }

    public function datatables(){
        $list = $this->KpiGroup->getAll();
        return Datatables::of($list)
        ->addColumn('action', function ($list) {
            return '<a href="'.route('kpi.group.edit', $list->id).'" class="btn btn-xs btn-warning">
                        <i class="fa fa-eye"></i> View</a>
                    <a href="javascript:void(0)" data-link="'.route('kpi.group.destroy', $list->id). '" class="btn btn-xs btn-danger btn-delete">
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
        return view('kpi::group.index');
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
        try{
            $this->KpiGroup->create($params);
            return $this->success('kpi.group.index');
        }catch (\Exception $e) {
            return $this->error('kpi.group.index');
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
        $info = $this->KpiGroup->findOrFail($id);
        $data['info'] = $info;
        return view('kpi::group.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $info = $this->KpiGroup->findOrFail($id);
        if($request->isMethod('put')){
            try{
                $params = $request->all();
                $params['updated_id'] = $this->getAdmin()->id;
                $info->fill($params);
                $info->save();
                return $this->success('kpi.group.index');
            }catch (\Exception $e) {
                return $this->error('kpi.group.index');
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
            $info = $this->KpiGroup->findOrFail($id);
            $info->delete();
            return ['status' => true, 'msg' => 'xóa thành công "' .$info->name.'"', 'data' => []];
        }catch (\Exception $e) {
            return ['status' => false, 'msg' => 'Có lỗi xảy ra vui lòng thực hiện lại', 'data' => []];
        }
    }
}
