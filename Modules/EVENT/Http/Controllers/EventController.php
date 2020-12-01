<?php

namespace Modules\EVENT\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\EVENT\Entities\EventType;
use Modules\EVENT\Entities\EventCategory;
use Modules\EVENT\Entities\EventGroup;
use Modules\EVENT\Entities\Event;
use Modules\EVENT\Entities\EventPriority;
use Modules\EVENT\Entities\Status;
use Modules\EVENT\Entities\EmployeeGroup;
use Modules\EVENT\Entities\EventUserFollow;
use Carbon\Carbon;
use Yajra\Datatables\Datatables;

class EventController extends BaseController
{

    public function __construct(){
        $this->EventType = new EventType();
        $this->EventCategory = new EventCategory();
        $this->EventGroup = new EventGroup();
        $this->EventPriority = new EventPriority();
        $this->Status = new Status();
        $this->EmployeeGroup = new EmployeeGroup();
        $this->Event = new Event();
        $this->EventUserFollow = new EventUserFollow();
    }

    public function datatable(){
        $event = $this->Event->with('assignUser', 'group', 'eventType', 'eventCategory', 'eventGroup', 'eventPriority', 'status')->get();
        return Datatables::of($event)
        ->addColumn('action', function ($event) {
            return '<a href="" class="btn btn-xs btn-warning">
                        <i class="fa fa-eye"></i> View</a>
                    <a href="" class="btn btn-xs btn-info">
                        <i class="fa fa-eye"></i> Chi tiết</a>
                    <a href="javascript:void(0)" data-link="" class="btn btn-xs btn-danger btn-delete">
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
        $eventTypeList = $this->EventType->getAll();
        $eventCategoryList = $this->EventCategory->getAll();
        $eventGroupList = $this->EventGroup->getAll();
        $eventPriorityList = $this->EventPriority->getAll();
        $statusList = $this->Status->getAll();
        $groupEmployee = $this->EmployeeGroup->getAll();
        $data = [
            'eventTypeList' => $eventTypeList,
            'eventCategoryList' => $eventCategoryList,
            'eventGroupList' => $eventGroupList,
            'eventPriorityList' => $eventPriorityList,
            'statusList' => $statusList,
            'groupEmployee' => $groupEmployee
        ];
        return view('event::index', $data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('event::create');
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
        $params['assign_user_id'] = $request->employee_id;
        try{
            $event = $this->Event->create($params);
            $userFollow = [];
            if(!empty($request->user_follow)){
                foreach($request->user_follow as $key => $row){
                    $userFollow[$key]['employee_id'] = $row;
                    $userFollow[$key]['event_id'] = $event->id;
                    $userFollow[$key]['created_id'] = $params['created_id'];
                    $userFollow[$key]['created_at'] = Carbon::now();
                    $userFollow[$key]['updated_at'] = Carbon::now();
                }
                $this->EventUserFollow->insert($userFollow);
            }
            return $this->success('event.event.index');
        }catch (\Exception $e) {
            return $this->error('event.event.index');
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('event::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('event::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }

    /**
     * calendar.
     * @return Renderable
     */
    public function calendar()
    {
        return view('event::calendar');
    }

    public function updateCalendar(Request $request){
        $id = $request->id;
        $startAt = date('Y/m/d H:i:s', ($request->startAt/1000));
        $endAt = date('Y/m/d H:i:s', ($request->endAt/1000));
        try{
            $event = $this->Event->findOrFail($id);
            $event->start_at = $startAt;
            $event->end_at = $endAt;
            $event->save();
            return response()->json([
                'status' => 200,
                'msg' => 'Success!',
                'data' => [$event]
            ]);
        }catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'msg' => 'internal server!',
                'data' => []
            ]);
        }
    }
}
