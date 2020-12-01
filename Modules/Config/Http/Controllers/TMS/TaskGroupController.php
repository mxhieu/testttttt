<?php

namespace Modules\Config\Http\Controllers\TMS;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Modules\Config\Entities\TaskGroup;
use Modules\Config\Http\Controllers\BaseController;
use Yajra\Datatables\Datatables;

class TaskGroupController extends BaseController
{

    protected $TaskGroup;
    
    public function __construct(TaskGroup $TaskGroup){
        $this->TaskGroup = $TaskGroup;
    }

    public function taskGroupData(){
        $taskGroupList = $this->TaskGroup->getAll();
        return Datatables::of($taskGroupList)
        ->addColumn('action', function ($taskGroupList) {
            return '<a href="'.route('config.taskgroup.edit', $taskGroupList->id).'" class="btn btn-xs btn-warning">
                        <i class="fa fa-eye"></i> View</a>
                    <a href="javascript:void(0)" data-link="'.route('config.taskgroup.destroy', $taskGroupList->id). '" class="btn btn-xs btn-danger btn-delete">
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
        return view('config::tms.taskgroup.index');
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
            $this->TaskGroup->create($params);
            return $this->success('config.taskgroup.index');
        }catch (\Exception $e) {
            return $this->error('config.taskgroup.index');
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
        $taskGroupInfo = $this->TaskGroup->findOrFail($id);
        $data['taskGroupInfo'] = $taskGroupInfo;
        return view('config::tms.taskgroup.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $taskGroupInfo = $this->TaskGroup->findOrFail($id);
        if($request->isMethod('put')){
            try{
                $params = $request->all();
                $params['updated_id'] = $this->getAdmin()->id;
                $taskGroupInfo->fill($params);
                $taskGroupInfo->save();
                return $this->success('config.taskgroup.index');
            }catch (\Exception $e) {
                return $this->error('config.taskgroup.index');
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
            $taskGroupInfo = $this->TaskGroup->findOrFail($id);
            $taskGroupInfo->delete();
            return ['status' => true, 'msg' => 'xóa thành công "' .$taskGroupInfo->name.'"', 'data' => []];
        }catch (\Exception $e) {
            return ['status' => false, 'msg' => 'Có lỗi xảy ra vui lòng thực hiện lại', 'data' => []];
        }
    }
}
