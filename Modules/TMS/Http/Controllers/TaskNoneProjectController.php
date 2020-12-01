<?php

namespace Modules\TMS\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Modules\TMS\Entities\TaskNoneProject;
use Modules\TMS\Entities\Department;
use Modules\TMS\Entities\Employee;
use Modules\TMS\Entities\EmployeeGroup;
use Modules\TMS\Entities\TaskPriority;
use Modules\TMS\Entities\TaskCategory;
use Modules\TMS\Entities\TaskGroup;
use Modules\TMS\Entities\TaskType;
use Modules\TMS\Entities\UserFollow;
use Modules\TMS\Entities\TaskProcess;
use Modules\TMS\Entities\TaskPhrase;
use Modules\TMS\Entities\Status;
use Modules\TMS\Http\Controllers\BaseController;
use Yajra\Datatables\Datatables;
use Carbon\Carbon;
class TaskNoneProjectController extends BaseController
{
    
    public function __construct(){
        $this->TaskNoneProject =  new TaskNoneProject();
        $this->Department = new Department();
        $this->Employee = new Employee();
        $this->TaskPriority = new TaskPriority();
        $this->TaskGroup = new TaskGroup();
        $this->TaskType = new TaskType();
        $this->UserFollow = new UserFollow();
        $this->TaskProcess = new TaskProcess();
        $this->TaskCategory = new TaskCategory();
        $this->EmployeeGroup = new EmployeeGroup();
        $this->Status = new Status();
        $this->TaskPhrase = new TaskPhrase();
    }

    public function TaskNoneProjectData(){
        $taskNoneProjectList = $this->TaskNoneProject->with(['userFollow', 'assignUser', 'department', 'taskType', 'taskGroup', 'taskPriority', 'taskProcess', 'status'])->where('created_id', $this->getAdmin()->id)->get();
        foreach($taskNoneProjectList as $row){
            $row->lastedProcess = $row->taskProcess->last();
        }
        return Datatables::of($taskNoneProjectList)
        ->addColumn('action', function ($taskNoneProjectList) {
            return '<a href="'.route('tms.tasknoneproject.edit', $taskNoneProjectList->id).'" class="btn btn-xs btn-warning">
                        <i class="fa fa-eye"></i> View</a>
                    <a href="'.route('tms.tasknoneproject.process', $taskNoneProjectList->id).'" class="btn btn-xs btn-info">
                        <i class="fa fa-eye"></i> Chi tiết</a>
                    <a href="javascript:void(0)" data-link="'.route('tms.tasknoneproject.destroy', $taskNoneProjectList->id). '" class="btn btn-xs btn-danger btn-delete">
                        <i class="fa fa-times"></i> Delete</a>';
        })
        ->addColumn('progress', function ($taskNoneProjectList) {
            $complete = isset($taskNoneProjectList->lastedProcess->complete) ? $taskNoneProjectList->lastedProcess->complete: 0;
            return '<div class="progress">
                        <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar"
                        aria-valuenow="'. $complete .'" aria-valuemin="0" aria-valuemax="100" style="width:'. $complete .'%">
                        '. $complete .'% Complete (success)
                        </div>
                    </div>
                    ';
        })
        ->rawColumns(['action', 'progress'])
        ->make(true);
    }

    public function home(){
        $allTask = TaskNoneProject::with('phrase', 'status')->get();
        $taskOfDay = $allTask->filter(function($item, $status) {
            if (Carbon::now()->between($item->start_at, $item->end_at)) {
                return $item;
            }
        });
        $taskInProcessing = $allTask->filter(function($item) {
            if ($item->phrase->id == 1) {
                return $item;
            }
        });
        $taskDelay = $allTask->filter(function($item) {
            if ($item->status->id == 4) {
                return $item;
            }
        });

        Carbon::setWeekStartsAt(Carbon::MONDAY);
        Carbon::setWeekEndsAt(Carbon::SUNDAY);
        $taskOfWeek = $allTask->filter(function($item, $status) {
            if (Carbon::now()->between(Carbon::now()->startOfWeek()->format('Y-m-d H:i:s'), Carbon::now()->endOfWeek()->format('Y-m-d H:i:s'))) {
                return $item;
            }
        });
        
        $data['allTask'] = $allTask;
        $data['taskOfDay'] = $taskOfDay;
        $data['taskInProcessing'] = $taskInProcessing;
        $data['taskDelay'] = $taskDelay;
        return view('tms::tasknoneproject.home', $data);
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $departmentList = $this->Department->with('employee')->get();
        $groupEmployee = $this->EmployeeGroup->getAll();
        $taskPriorityList = $this->TaskPriority->getAll();
        $taskGrouptList = $this->TaskGroup->getAll();
        $taskTypetList = $this->TaskType->getAll();
        $taskCategoryList = $this->TaskCategory->getAll();
        $statusList = $this->Status->getAll();
        $taskPhraseList = $this->TaskPhrase->getAll();
        $data = [
            'departmentList' => $departmentList,
            'groupEmployee' => $groupEmployee,
            'taskPriorityList' => $taskPriorityList,
            'taskGrouptList' => $taskGrouptList,
            'taskTypetList' => $taskTypetList,
            'taskCategoryList' => $taskCategoryList,
            'statusList' => $statusList,
            'taskPhraseList' => $taskPhraseList
        ];
        return view('tms::tasknoneproject.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(Request $request)
    {
        return view('tms::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $params = $request->all();
        $arrTime = explode(' - ', $params['datetimes']);
        $params['start_at'] = $this->formatTime($arrTime[0]);
        $params['end_at'] = $this->formatTime($arrTime[1]);
        $params['created_id'] = $this->getAdmin()->id;
        $params['code'] = $this->generateCode('TMS-PROJECT-');
        if($request->has('file')){
            $params['attach_file'] = $this->uploadFile($request, $request->file , 'tms/file');
        }
        $params['assign_user_id'] = $request->employee_id;
        try{
            $taskNoneProject = $this->TaskNoneProject->create($params);
            $userFollow = [];
            if(!empty($request->user_follow)){
                foreach($request->user_follow as $key => $row){
                    $userFollow[$key]['employee_id'] = $row;
                    $userFollow[$key]['task_id'] = $taskNoneProject->id;
                    $userFollow[$key]['task_type'] = 'noneproject';
                    $userFollow[$key]['created_id'] = $params['created_id'];
                    $userFollow[$key]['created_at'] = Carbon::now();
                    $userFollow[$key]['updated_at'] = Carbon::now();
                }
                $this->UserFollow->insert($userFollow);
            }
            return $this->success('tms.tasknoneproject.index');
        }catch (\Exception $e) {
            return $this->error('tms.tasknoneproject.index');
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
        $taskNoneProjectInfo = $this->TaskNoneProject->findOrFail($id);
        $data['taskNoneProjectInfo'] = $taskNoneProjectInfo;
        return view('tms::tasknoneproject.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $taskNoneProjectInfo = $this->TaskNoneProject->findOrFail($id);
        if($request->isMethod('put')){
            try{
                $params = $request->all();
                $params['updated_id'] = $this->getAdmin()->id;
                $taskNoneProjectInfo->fill($params);
                $taskNoneProjectInfo->save();
                return $this->success('tms.tasknoneproject.index');
            }catch (\Exception $e) {
                return $this->error('tms.tasknoneproject.index');
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
            $taskNoneProjectInfo = $this->TaskNoneProject->findOrFail($id);
            $taskNoneProjectInfo->delete();
            return ['status' => true, 'msg' => 'xóa thành công "' .$taskNoneProjectInfo->name.'"', 'data' => []];
        }catch (\Exception $e) {
            return ['status' => false, 'msg' => 'Có lỗi xảy ra vui lòng thực hiện lại', 'data' => []];
        }
    }

    public function taskNoneProjectprocess(Request $request, $id){
        $task = $this->TaskNoneProject->findOrFail($id);
        $taskProcessList = $this->TaskProcess->where('task_id', $id)->get();
        $statusList = $this->Status->getAll();
        if($request->isMethod('post')){
            $params = $request->all();
            $params['task_id'] = $task->id;
            $params['created_id'] = $this->getAdmin()->id;
            if($request->has('attach_file')){
                $params['attach_file'] = $this->uploadFile($request, $request->attach_file , 'tms/file');
            }
            try{
                $this->TaskProcess->create($params);
                return $this->success('tms.tasknoneproject.process', $task->id);
            }catch (\Exception $e) {
                return $this->error('tms.tasknoneproject.process');
            }
        }
        $data['taskProcessList'] = $taskProcessList;
        $data['statusList'] = $statusList;
        return view('tms::tasknoneproject.process', $data);
    }

    public function kanban(){
        $taskNoneProjectList = $this->TaskNoneProject->with(['userFollow', 'assignUser', 'department', 'taskType', 'taskGroup', 'taskPriority', 'taskProcess', 'status'])->where('created_id', $this->getAdmin()->id)->get();
        $departmentList = $this->Department->with('employee')->get();
        $groupEmployee = $this->EmployeeGroup->getAll();
        $taskPriorityList = $this->TaskPriority->getAll();
        $taskGrouptList = $this->TaskGroup->getAll();
        $taskTypetList = $this->TaskType->getAll();
        $taskCategoryList = $this->TaskCategory->getAll();
        $statusList = $this->Status->getAll();
        $taskPhraseList = $this->TaskPhrase->getAll();
        $data = [
            'departmentList' => $departmentList,
            'groupEmployee' => $groupEmployee,
            'taskPriorityList' => $taskPriorityList,
            'taskGrouptList' => $taskGrouptList,
            'taskTypetList' => $taskTypetList,
            'taskCategoryList' => $taskCategoryList,
            'statusList' => $statusList,
            'taskPhraseList' => $taskPhraseList,
            'taskNoneProjectList' => $taskNoneProjectList
        ];
        return view('tms::tasknoneproject.kanban', $data);
    }

    public function updateKanban(Request $request){
        if($request->ajax()){
            $taskId = $request->taskId;
            $taskGridType = $request->taskGridType;
            $taskGridId = $request->taskGridId;
            $taskInfo = $this->TaskNoneProject->find($taskId);
            if(!empty($taskInfo)){
                if($taskGridType == "department"){
                    $taskInfo->department_id = $taskGridId;
                }elseif($taskGridType == "categories"){
                    $taskInfo->task_category_id = $taskGridId;
                }elseif($taskGridType == "phrase"){
                    $taskInfo->task_phrase_id = $taskGridId;
                }else{
                    $taskInfo->status_id = $taskGridId;
                }
                $taskInfo->updated_id = $this->getAdmin()->id;
                try{
                    $taskInfo->save();
                    return response()->json([
                        'status' => 200,
                        'msg' => 'Success!',
                        'data' => [$taskInfo]
                    ]);
                }catch (\Exception $e) {
                    return response()->json([
                        'status' => 500,
                        'msg' => 'internal server!',
                        'data' => []
                    ]);
                }
                
            }else{
                return response()->json([
                    'status' => 404,
                    'msg' => 'Task not found!',
                    'data' => []
                ]);
            }
        }
    }

    public function ganttChart(){
        return view('tms::tasknoneproject.ganttchart');
    }
}
