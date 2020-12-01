<?php

namespace Modules\Config\Http\Controllers\HRM;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Modules\Config\Entities\DepartMent;
use Modules\Config\Http\Controllers\BaseController;
use Yajra\Datatables\Datatables;

class DepartmentController extends BaseController
{
    protected $DepartMent;
    
    public function __construct(DepartMent $DepartMent){
        $this->DepartMent = $DepartMent;
    }

    public function DepartMentData(){
        $departMentList = $this->DepartMent->getAll();
        return Datatables::of($departMentList)
        ->addColumn('action', function ($departMentList) {
            return '<a href="'.route('config.department.edit', $departMentList->id).'" class="btn btn-xs btn-warning">
                        <i class="fa fa-eye"></i> View</a>
                    <a href="javascript:void(0)" data-link="'.route('config.department.destroy', $departMentList->id). '" class="btn btn-xs btn-danger btn-delete">
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
        return view('config::hrm.department.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(Request $request)
    {
        return view('config::hrm.create');
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
            $this->DepartMent->create($params);
            return $this->success('config.department.index');
        }catch (\Exception $e) {
            return $this->error('config.department.index');
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
        $departmentInfo = $this->DepartMent->findOrFail($id);
        $data['departmentInfo'] = $departmentInfo;
        return view('config::hrm.department.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $departMentInfo = $this->DepartMent->findOrFail($id);
        if($request->isMethod('put')){
            try{
                $params = $request->all();
                $params['updated_id'] = $this->getAdmin()->id;
                $departMentInfo->fill($params);
                $departMentInfo->save();
                return $this->success('config.department.index');
            }catch (\Exception $e) {
                return $this->error('config.department.index');
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
            $departMentInfo = $this->DepartMent->findOrFail($id);
            $departMentInfo->delete();
            return ['status' => true, 'msg' => 'xóa thành công "' .$departMentInfo->name.'"', 'data' => []];
        }catch (\Exception $e) {
            return ['status' => false, 'msg' => 'Có lỗi xảy ra vui lòng thực hiện lại', 'data' => []];
        }
    }
}
