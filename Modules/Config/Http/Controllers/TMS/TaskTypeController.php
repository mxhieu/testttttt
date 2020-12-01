<?php

namespace Modules\Config\Http\Controllers\TMS;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Modules\Config\Http\Controllers\BaseController;
use Modules\Config\Entities\TaskType;
use Yajra\Datatables\Datatables;

class TaskTypeController extends BaseController
{
    protected $TaskType;
    
    public function __construct(TaskType $TaskType){
        $this->TaskType = $TaskType;
    }

    public function TaskTypeData(){
        $TaskTypeList = $this->TaskType->getAll();
        return Datatables::of($TaskTypeList)
        ->addColumn('action', function ($TaskTypeList) {
            return '<a href="'.route('config.tasktype.edit', $TaskTypeList->id).'" class="btn btn-xs btn-warning">
                        <i class="fa fa-eye"></i> View</a>
                    <a href="javascript:void(0)" data-link="'.route('config.tasktype.destroy', $TaskTypeList->id). '" class="btn btn-xs btn-danger btn-delete">
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
        return view('config::tms.tasktype.index');
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
            $this->TaskType->create($params);
            return $this->success('config.tasktype.index');
        }catch (\Exception $e) {
            return $this->error('config.tasktype.index');
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
        $taskTypeInfo = $this->TaskType->findOrFail($id);
        $data['taskTypeInfo'] = $taskTypeInfo;
        return view('config::tms.tasktype.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $TaskTypeInfo = $this->TaskType->findOrFail($id);
        if($request->isMethod('put')){
            try{
                $params = $request->all();
                $params['updated_id'] = $this->getAdmin()->id;
                $TaskTypeInfo->fill($params);
                $TaskTypeInfo->save();
                return $this->success('config.tasktype.index');
            }catch (\Exception $e) {
                return $this->error('config.tasktype.index');
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
            $TaskTypeInfo = $this->TaskType->findOrFail($id);
            $TaskTypeInfo->delete();
            return ['status' => true, 'msg' => 'xóa thành công "' .$TaskTypeInfo->name.'"', 'data' => []];
        }catch (\Exception $e) {
            return ['status' => false, 'msg' => 'Có lỗi xảy ra vui lòng thực hiện lại', 'data' => []];
        }
    }
}
