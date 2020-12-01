<?php

namespace Modules\Config\Http\Controllers\HRM;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Modules\Config\Entities\Employee;
use Modules\Config\Entities\EmployeeGroup;
use Modules\Config\Entities\GroupDetail;
use Modules\Config\Http\Controllers\BaseController;
use Yajra\Datatables\Datatables;

class EmployeeGroupController extends BaseController
{

    protected $employeeGroup;
    
    public function __construct(EmployeeGroup $employeeGroup)
    {
        $this->employeeGroup = $employeeGroup;
    }

    public function employeeGroupData()
    {
        $employeegroupList = $this->employeeGroup->getAll();
        return Datatables::of($employeegroupList)
        ->addColumn('action', function ($employeegroupList) {
            return '<a href="'.route('config.employeegroup.edit', $employeegroupList->id).'" class="btn btn-xs btn-warning">
                        <i class="fa fa-eye"></i> View</a>
                    <a href="'.route('config.groupdetail.index', $employeegroupList->id).'" class="btn btn-xs btn-info">
                        <i class="fa fa-eye"></i> Nhân sự</a>
                    <a href="javascript:void(0)" data-link="'.route('config.employeegroup.destroy', $employeegroupList->id). '" class="btn btn-xs btn-danger btn-delete">
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
        return view('config::hrm.employeegroup.index');
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
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $params = $request->all();
        $params['created_id'] = $this->getAdmin()->id;
        try{
            $this->employeeGroup->create($params);
            return $this->success('config.employeegroup.index');
        }catch (\Exception $e) {
            return $this->error('config.employeegroup.index');
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
        $employeegroupInfo = $this->EmployeeGroup->findOrFail($id);
        $data['employeegroupInfo'] = $employeegroupInfo;
        return view('config::hrm.employeegroup.edit', $data);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $employeegroupInfo = $this->EmployeeGroup->findOrFail($id);
        if($request->isMethod('put')){
            try{
                $params = $request->all();
                $params['updated_id'] = $this->getAdmin()->id;
                $employeegroupInfo->fill($params);
                $employeegroupInfo->save();
                return $this->success('config.employeegroup.index');
            }catch (\Exception $e) {
                return $this->error('config.employeegroup.index');
            }
        }
    }

    /**
     * @param $id
     * @return array
     */
    public function destroy($id)
    {
        try{
            $employeegroupInfo = $this->EmployeeGroup->findOrFail($id);
            $employeegroupInfo->delete();
            return ['status' => true, 'msg' => 'xóa thành công "' .$employeegroupInfo->name.'"', 'data' => []];
        }catch (\Exception $e) {
            return ['status' => false, 'msg' => 'Có lỗi xảy ra vui lòng thực hiện lại', 'data' => []];
        }
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getUser($id)
    {
        $employeeIds = GroupDetail::where(['employee_group_id' => $id])->get(['employee_id'])->pluck('employee_id')->toArray();
        if (!empty($employeeIds)) {
            $data = Employee::whereIn('id', $employeeIds)->get(['id', 'name'])->pluck('name', 'id')->toArray();
            return $data;
        }
        return $employeeIds;
    }
}
