<?php

namespace Modules\Config\Http\Controllers\HRM;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Modules\Config\Entities\GroupDetail;
use Modules\Config\Entities\Department;
use Modules\Config\Http\Controllers\BaseController;
use Yajra\Datatables\Datatables;

class GroupDetailController extends BaseController
{

    protected $GroupDetail, $Department;
    
    public function __construct(GroupDetail $GroupDetail, Department $Department){
        $this->GroupDetail = $GroupDetail;
        $this->Department = $Department;
    }

    public function groupDetailData($id){
        $groupDetailList = $this->GroupDetail->getAll($id);
        return Datatables::of($groupDetailList)
        ->addColumn('action', function ($groupDetailList) {
            return '
                    <a href="javascript:void(0)" data-link="'.route('config.groupdetail.delete', ['groupId' => $groupDetailList->employee_group_id, 'id' => $groupDetailList->id]). '" class="btn btn-xs btn-danger btn-delete">
                        <i class="fa fa-times"></i> Delete</a>';
        })
        ->addColumn('role', function ($groupDetailList) {
            $roleTagOption = '';
            foreach(config('const')['USER_ROLE'] as $key => $row){
                $selected = $groupDetailList->role_id == $key?"selected":"";
                $roleTagOption .= '<option '. $selected .' value="'. $key .'">'. $row .'</option>';
            }
            return '<select class="form-control update_role_id" data-url="'. route('config.groupdetail.update', ['groupId' => $groupDetailList->employee_group_id, 'id' => $groupDetailList->id]) .'" name="update_role_id">
                    '. $roleTagOption .'
                    </select>';
        })
        ->rawColumns(['action', 'role'])
        ->make(true);
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index($groudId)
    {
        $departmentList = $this->Department->getAll();
        $data['departmentList'] = $departmentList;
        $data['groudId'] = $groudId;
        return view('config::hrm.groupdetail.index', $data);
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
    public function store(Request $request, $groupId)
    {
        $params = $request->all();
        $params['created_id'] = $this->getAdmin()->id;
        $params['employee_group_id'] = $groupId;
        if(!$this->GroupDetail->checkInGroup($groupId, $params['employee_id'])){
            try{
                $this->GroupDetail->create($params);
                return $this->success('config.groupdetail.index', ['groupId' => $groupId]);
            }catch (\Exception $e) {
                return $this->error('config.groupdetail.index', ['groupId' => $groupId]);
            }
        }
        return redirect()->back()->with(['level' => 'error', 'message' => 'Đã tồn tại user trong group!']);
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
        $groupdetailInfo = $this->GroupDetail->findOrFail($id);
        $data['groupdetailInfo'] = $groupdetailInfo;
        return view('config::hrm.groupdetail.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $groupId, $id)
    {
        $groupdetailInfo = $this->GroupDetail->findOrFail($id);
        if($request->isMethod('post')){
            try{
                $params['role_id'] = $request->role_id;
                $params['updated_id'] = $this->getAdmin()->id;
                $groupdetailInfo->fill($params);
                $groupdetailInfo->save();
                return ['status' => true, 'msg' => 'Cập nhật thành công', 'data' => []];
            }catch (\Exception $e) {
                return ['status' => false, 'msg' => 'Có lỗi xảy ra vui lòng thực hiện lại', 'data' => []];
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($groupId ,$id)
    {
        try{
            $groupdetailInfo = $this->GroupDetail->findOrFail($id);
            $groupdetailInfo->delete();
            return ['status' => true, 'msg' => 'xóa thành công!', 'data' => []];
        }catch (\Exception $e) {
            return ['status' => false, 'msg' => 'Có lỗi xảy ra vui lòng thực hiện lại', 'data' => []];
        }
    }
}

