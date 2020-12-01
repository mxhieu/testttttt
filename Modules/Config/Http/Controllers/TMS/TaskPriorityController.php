<?php

namespace Modules\CONFIG\Http\Controllers\TMS;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Modules\Config\Entities\TaskPriority;
use Modules\Config\Http\Controllers\BaseController;
use Yajra\Datatables\Datatables;

class TaskPriorityController extends BaseController
{

    protected $TaskPriority;
    
    public function __construct(TaskPriority $TaskPriority){
        $this->TaskPriority = $TaskPriority;
    }

    public function TaskPriorityData(){
        $taskPriorityList = $this->TaskPriority->getAll();
        return Datatables::of($taskPriorityList)
        ->addColumn('action', function ($taskPriorityList) {
            return '<a href="'.route('config.taskpriority.edit', $taskPriorityList->id).'" class="btn btn-xs btn-warning">
                        <i class="fa fa-eye"></i> View</a>
                    <a href="javascript:void(0)" data-link="'.route('config.taskpriority.destroy', $taskPriorityList->id). '" class="btn btn-xs btn-danger btn-delete">
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
        return view('config::tms.taskpriority.index');
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
            $this->TaskPriority->create($params);
            return $this->success('config.taskpriority.index');
        }catch (\Exception $e) {
            return $this->error('config.taskpriority.index');
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
        $taskPriorityInfo = $this->TaskPriority->findOrFail($id);
        $data['taskPriorityInfo'] = $taskPriorityInfo;
        return view('config::tms.taskpriority.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $taskPriorityInfo = $this->TaskPriority->findOrFail($id);
        if($request->isMethod('put')){
            try{
                $params = $request->all();
                $params['updated_id'] = $this->getAdmin()->id;
                $taskPriorityInfo->fill($params);
                $taskPriorityInfo->save();
                return $this->success('config.taskpriority.index');
            }catch (\Exception $e) {
                return $this->error('config.taskpriority.index');
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
            $taskPriorityInfo = $this->TaskPriority->findOrFail($id);
            $taskPriorityInfo->delete();
            return ['status' => true, 'msg' => 'xóa thành công "' .$taskPriorityInfo->name.'"', 'data' => []];
        }catch (\Exception $e) {
            return ['status' => false, 'msg' => 'Có lỗi xảy ra vui lòng thực hiện lại', 'data' => []];
        }
    }
}
