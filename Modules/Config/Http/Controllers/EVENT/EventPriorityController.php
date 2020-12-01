<?php

namespace Modules\Config\Http\Controllers\EVENT;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Config\Entities\EventPriority;
use Modules\Config\Http\Controllers\BaseController;
use Yajra\Datatables\Datatables;

class EventPriorityController extends BaseController
{

    protected $EventPriority;
    
    public function __construct(EventPriority $EventPriority){
        $this->EventPriority = $EventPriority;
    }

    public function EventPriorityData(){
        $eventPriorityList = $this->EventPriority->getAll();
        return Datatables::of($eventPriorityList)
        ->addColumn('action', function ($eventPriorityList) {
            return '<a href="'.route('config.eventpriority.edit', $eventPriorityList->id).'" class="btn btn-xs btn-warning">
                        <i class="fa fa-eye"></i> View</a>
                    <a href="javascript:void(0)" data-link="'.route('config.eventpriority.destroy', $eventPriorityList->id). '" class="btn btn-xs btn-danger btn-delete">
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
        return view('config::event.eventpriority.index');
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
            $this->EventPriority->create($params);
            return $this->success('config.eventpriority.index');
        }catch (\Exception $e) {
            return $this->error('config.eventpriority.index');
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
        $eventPriorityInfo = $this->EventPriority->findOrFail($id);
        $data['eventPriorityInfo'] = $eventPriorityInfo;
        return view('config::event.eventpriority.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $eventPriorityInfo = $this->EventPriority->findOrFail($id);
        if($request->isMethod('put')){
            try{
                $params = $request->all();
                $params['updated_id'] = $this->getAdmin()->id;
                $eventPriorityInfo->fill($params);
                $eventPriorityInfo->save();
                return $this->success('config.eventpriority.index');
            }catch (\Exception $e) {
                return $this->error('config.eventpriority.index');
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
            $eventPriorityInfo = $this->EventPriority->findOrFail($id);
            $eventPriorityInfo->delete();
            return ['status' => true, 'msg' => 'xóa thành công "' .$eventPriorityInfo->name.'"', 'data' => []];
        }catch (\Exception $e) {
            return ['status' => false, 'msg' => 'Có lỗi xảy ra vui lòng thực hiện lại', 'data' => []];
        }
    }
}
