<?php

namespace Modules\Config\Http\Controllers\HRM;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Modules\Config\Entities\Employee;
use Modules\Config\Entities\Department;
use Modules\Config\Entities\Position;
use Modules\Config\Http\Controllers\BaseController;
use Yajra\Datatables\Datatables;
class EmployeeController extends BaseController
{
    protected $Employee;
    
    public function __construct(Employee $Employee, Department $Department, Position $Position){
        $this->Employee = $Employee;
        $this->Department = $Department;
        $this->Position = $Position;
    }

    public function employeeData(){
        $EmployeeList = $this->Employee->getAll();
        return Datatables::of($EmployeeList)
        ->addColumn('action', function ($EmployeeList) {
            return '<a href="'.route('config.employee.edit', $EmployeeList->id).'" class="btn btn-xs btn-warning">
                        <i class="fa fa-eye"></i> View</a>
                    <a href="javascript:void(0)" data-link="'.route('config.employee.destroy', $EmployeeList->id). '" class="btn btn-xs btn-danger btn-delete">
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
        $departmentList = $this->Department->getAll();
        $positionList = $this->Position->getAll();
        $data['departmentList'] = $departmentList;
        $data['positionList'] = $positionList;
        return view('config::hrm.employee.index', $data);
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
            $this->Employee->create($params);
            return $this->success('config.employee.index');
        }catch (\Exception $e) {
            return $this->error('config.employee.index');
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
        $EmployeeInfo = $this->Employee->findOrFail($id);
        $data['EmployeeInfo'] = $EmployeeInfo;
        return view('config::hrm.employee.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $EmployeeInfo = $this->Employee->findOrFail($id);
        if($request->isMethod('put')){
            try{
                $params = $request->all();
                $params['updated_id'] = $this->getAdmin()->id;
                $EmployeeInfo->fill($params);
                $EmployeeInfo->save();
                return $this->success('config.employee.index');
            }catch (\Exception $e) {
                return $this->error('config.employee.index');
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
            $EmployeeInfo = $this->Employee->findOrFail($id);
            $EmployeeInfo->delete();
            return ['status' => true, 'msg' => 'xóa thành công "' .$EmployeeInfo->name.'"', 'data' => []];
        }catch (\Exception $e) {
            return ['status' => false, 'msg' => 'Có lỗi xảy ra vui lòng thực hiện lại', 'data' => []];
        }
    }
}
