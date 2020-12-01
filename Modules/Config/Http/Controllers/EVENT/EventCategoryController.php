<?php

namespace Modules\Config\Http\Controllers\EVENT;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Modules\Config\Entities\EventCategory;
use Modules\Config\Http\Controllers\BaseController;
use Yajra\Datatables\Datatables;

class EventCategoryController extends BaseController
{

    protected $EventCategory;
    
    public function __construct(EventCategory $EventCategory){
        $this->EventCategory = $EventCategory;
    }

    public function eventCategoryData(){
        $eventCategoryList = $this->EventCategory->getAll();
        return Datatables::of($eventCategoryList)
        ->addColumn('action', function ($eventCategoryList) {
            return '<a href="'.route('config.eventcategory.edit', $eventCategoryList->id).'" class="btn btn-xs btn-warning">
                        <i class="fa fa-eye"></i> View</a>
                    <a href="javascript:void(0)" data-link="'.route('config.eventcategory.destroy', $eventCategoryList->id). '" class="btn btn-xs btn-danger btn-delete">
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
        return view('config::event.eventcategory.index');
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
            $this->EventCategory->create($params);
            return $this->success('config.eventcategory.index');
        }catch (\Exception $e) {
            return $this->error('config.eventcategory.index');
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
        $eventCategoryInfo = $this->EventCategory->findOrFail($id);
        $data['eventCategoryInfo'] = $eventCategoryInfo;
        return view('config::event.eventcategory.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $eventCategoryInfo = $this->EventCategory->findOrFail($id);
        if($request->isMethod('put')){
            try{
                $params = $request->all();
                $params['updated_id'] = $this->getAdmin()->id;
                $eventCategoryInfo->fill($params);
                $eventCategoryInfo->save();
                return $this->success('config.eventcategory.index');
            }catch (\Exception $e) {
                return $this->error('config.eventcategory.index');
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
            $eventCategoryInfo = $this->EventCategory->findOrFail($id);
            $eventCategoryInfo->delete();
            return ['status' => true, 'msg' => 'xóa thành công "' .$eventCategoryInfo->name.'"', 'data' => []];
        }catch (\Exception $e) {
            return ['status' => false, 'msg' => 'Có lỗi xảy ra vui lòng thực hiện lại', 'data' => []];
        }
    }
}
