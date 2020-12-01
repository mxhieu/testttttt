<?php

namespace Modules\Config\Http\Controllers\Status;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Modules\Config\Entities\Status;
use Modules\Config\Http\Controllers\BaseController;
use Yajra\Datatables\Datatables;

class StatusController extends BaseController
{
    protected $Status;
    
    public function __construct(Status $Status){
        $this->Status = $Status;
    }

    public function statusData(){
        $statusList = $this->Status->getAll();
        return Datatables::of($statusList)
        ->addColumn('action', function ($statusList) {
            return '<a href="'.route('config.status.edit', $statusList->id).'" class="btn btn-xs btn-warning">
                        <i class="fa fa-eye"></i> View</a>
                    <a href="javascript:void(0)" data-link="'.route('config.status.destroy', $statusList->id). '" class="btn btn-xs btn-danger btn-delete">
                        <i class="fa fa-times"></i> Delete</a>';
        })
        ->addColumn('span-color', function ($statusList) {
            return '<span style="background: '.$statusList->color.'; width: 50px; height:25px; display: block"></span>';
        })
        ->rawColumns(['action', 'span-color'])
        ->make(true);
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('config::status.status.index');
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
            $this->Status->create($params);
            return $this->success('config.status.index');
        }catch (\Exception $e) {
            return $this->error('config.status.index');
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
        $statusInfo = $this->Status->findOrFail($id);
        $data['statusInfo'] = $statusInfo;
        return view('config::status.status.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $statusInfo = $this->Status->findOrFail($id);
        if($request->isMethod('put')){
            try{
                $params = $request->all();
                $params['updated_id'] = $this->getAdmin()->id;
                $statusInfo->fill($params);
                $statusInfo->save();
                return $this->success('config.status.index');
            }catch (\Exception $e) {
                return $this->error('config.status.index');
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
            $statusInfo = $this->Status->findOrFail($id);
            $statusInfo->delete();
            return ['status' => true, 'msg' => 'xóa thành công "' .$statusInfo->name.'"', 'data' => []];
        }catch (\Exception $e) {
            return ['status' => false, 'msg' => 'Có lỗi xảy ra vui lòng thực hiện lại', 'data' => []];
        }
    }
}
