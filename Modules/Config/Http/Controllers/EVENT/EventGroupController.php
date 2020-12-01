<?php

namespace Modules\Config\Http\Controllers\EVENT;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Modules\Config\Entities\EventGroup;
use Modules\Config\Http\Controllers\BaseController;
use Yajra\Datatables\Datatables;

class EventGroupController extends BaseController
{

    protected $EventGroup;
    
    public function __construct(EventGroup $EventGroup){
        $this->EventGroup = $EventGroup;
    }

    public function eventGroupData(){
        $eventGroupList = $this->EventGroup->getAll();
        return Datatables::of($eventGroupList)
        ->addColumn('action', function ($eventGroupList) {
            return '<a href="'.route('config.eventgroup.edit', $eventGroupList->id).'" class="btn btn-xs btn-warning">
                        <i class="fa fa-eye"></i> View</a>
                    <a href="javascript:void(0)" data-link="'.route('config.eventgroup.destroy', $eventGroupList->id). '" class="btn btn-xs btn-danger btn-delete">
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
        return view('config::event.eventgroup.index');
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
            $this->EventGroup->create($params);
            return $this->success('config.eventgroup.index');
        }catch (\Exception $e) {
            return $this->error('config.eventgroup.index');
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
        $eventGroupInfo = $this->EventGroup->findOrFail($id);
        $data['eventGroupInfo'] = $eventGroupInfo;
        return view('config::event.eventgroup.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $eventGroupInfo = $this->EventGroup->findOrFail($id);
        if($request->isMethod('put')){
            try{
                $params = $request->all();
                $params['updated_id'] = $this->getAdmin()->id;
                $eventGroupInfo->fill($params);
                $eventGroupInfo->save();
                return $this->success('config.eventgroup.index');
            }catch (\Exception $e) {
                return $this->error('config.eventgroup.index');
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
            $eventGroupInfo = $this->EventGroup->findOrFail($id);
            $eventGroupInfo->delete();
            return ['status' => true, 'msg' => 'xóa thành công "' .$eventGroupInfo->name.'"', 'data' => []];
        }catch (\Exception $e) {
            return ['status' => false, 'msg' => 'Có lỗi xảy ra vui lòng thực hiện lại', 'data' => []];
        }
    }
}
