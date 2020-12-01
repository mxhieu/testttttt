<?php

namespace Modules\Config\Http\Controllers\EVENT;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Modules\Config\Entities\EventType;
use Modules\Config\Http\Controllers\BaseController;
use Yajra\Datatables\Datatables;

class EventTypeController extends BaseController
{

    protected $EventType;
    
    public function __construct(EventType $EventType){
        $this->EventType = $EventType;
    }

    public function eventTypeData(){
        $eventTypeList = $this->EventType->getAll();
        return Datatables::of($eventTypeList)
        ->addColumn('action', function ($eventTypeList) {
            return '<a href="'.route('config.eventtype.edit', $eventTypeList->id).'" class="btn btn-xs btn-warning">
                        <i class="fa fa-eye"></i> View</a>
                    <a href="javascript:void(0)" data-link="'.route('config.eventtype.destroy', $eventTypeList->id). '" class="btn btn-xs btn-danger btn-delete">
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
        return view('config::event.eventtype.index');
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
            $this->EventType->create($params);
            return $this->success('config.eventtype.index');
        }catch (\Exception $e) {
            return $this->error('config.eventtype.index');
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
        $eventTypeInfo = $this->EventType->findOrFail($id);
        $data['eventTypeInfo'] = $eventTypeInfo;
        return view('config::event.eventtype.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $eventTypeInfo = $this->EventType->findOrFail($id);
        if($request->isMethod('put')){
            try{
                $params = $request->all();
                $params['updated_id'] = $this->getAdmin()->id;
                $eventTypeInfo->fill($params);
                $eventTypeInfo->save();
                return $this->success('config.eventtype.index');
            }catch (\Exception $e) {
                return $this->error('config.eventtype.index');
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
            $eventTypeInfo = $this->EventType->findOrFail($id);
            $eventTypeInfo->delete();
            return ['status' => true, 'msg' => 'xóa thành công "' .$eventTypeInfo->name.'"', 'data' => []];
        }catch (\Exception $e) {
            return ['status' => false, 'msg' => 'Có lỗi xảy ra vui lòng thực hiện lại', 'data' => []];
        }
    }
}
