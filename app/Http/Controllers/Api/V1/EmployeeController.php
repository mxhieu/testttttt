<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Department;
use App\Employee;
use App\EmployeeGroup;
class EmployeeController extends Controller
{
    protected $Department, $Employee;

    public function __construct(){
        $this->Department = new Department;
        $this->Employee = new Employee;
        $this->EmployeeGroup = new EmployeeGroup;
    }

    public function getEmployeeByDepartment($departmentId){
        try{
            $employeeList = $this->Employee->where('department_id', $departmentId)->get();
            return response()->json([
                'status' => 200,
                'msg' => 'Thành công!',
                'data' => $employeeList
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'msg' => 'internal server!',
                'data' => []
            ]);
        }
    }

    public function getEmployeeByGroup($groupId){
        try{
            $data = $this->EmployeeGroup->with('groupDetail')->find($groupId);
            return response()->json([
                'status' => 200,
                'msg' => 'Thành công!',
                'data' => $data
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'msg' => 'internal server!',
                'data' => []
            ]);
        }
    }
}
