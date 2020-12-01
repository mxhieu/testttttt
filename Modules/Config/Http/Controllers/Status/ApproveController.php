<?php

namespace Modules\Config\Http\Controllers\Status;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Modules\Config\Entities\Approve;
use Modules\Config\Http\Controllers\BaseController;
use Yajra\Datatables\Datatables;

class ApproveController extends BaseController
{
    protected $Approve;
    
    public function __construct(Approve $Approve){
        $this->Approve = $Approve;
    }

    public function approveData(){
        $approveList = $this->Approve->getAll();
        return Datatables::of($approveList)
        ->addColumn('action', function ($approveList) {
            return '<a href="'.route('config.approve.edit', $approveList->id).'" class="btn btn-xs btn-warning">
                        <i class="fa fa-eye"></i> View</a>
                    <a href="javascript:void(0)" data-link="'.route('config.approve.destroy', $approveList->id). '" class="btn btn-xs btn-danger btn-delete">
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
        return view('config::status.approve.index');
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
            $this->Approve->create($params);
            return $this->success('config.approve.index');
        }catch (\Exception $e) {
            return $this->error('config.approve.index');
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
        $approveInfo = $this->Approve->findOrFail($id);
        $data['approveInfo'] = $approveInfo;
        return view('config::status.approve.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $approveInfo = $this->Approve->findOrFail($id);
        if($request->isMethod('put')){
            try{
                $params = $request->all();
                $params['updated_id'] = $this->getAdmin()->id;
                $approveInfo->fill($params);
                $approveInfo->save();
                return $this->success('config.approve.index');
            }catch (\Exception $e) {
                return $this->error('config.approve.index');
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
            $approveInfo = $this->Approve->findOrFail($id);
            $approveInfo->delete();
            return ['status' => true, 'msg' => 'xóa thành công "' .$approveInfo->name.'"', 'data' => []];
        }catch (\Exception $e) {
            return ['status' => false, 'msg' => 'Có lỗi xảy ra vui lòng thực hiện lại', 'data' => []];
        }
    }
}
