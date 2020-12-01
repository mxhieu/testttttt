<?php

namespace Modules\Config\Http\Controllers\HRM;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Modules\Config\Entities\Position;
use Modules\Config\Http\Controllers\BaseController;
use Yajra\Datatables\Datatables;

class PositionController extends BaseController
{

    protected $Position;
    
    public function __construct(Position $Position){
        $this->Position = $Position;
    }

    public function positionData(){
        $positionList = $this->Position->getAll();
        return Datatables::of($positionList)
        ->addColumn('action', function ($positionList) {
            return '<a href="'.route('config.position.edit', $positionList->id).'" class="btn btn-xs btn-warning">
                        <i class="fa fa-eye"></i> View</a>
                    <a href="javascript:void(0)" data-link="'.route('config.position.destroy', $positionList->id). '" class="btn btn-xs btn-danger btn-delete">
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
        return view('config::hrm.position.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(Request $request)
    {
        return view('config::hrm.create');
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
            $this->Position->create($params);
            return $this->success('config.position.index');
        }catch (\Exception $e) {
            return $this->error('config.position.index');
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
        $positionInfo = $this->Position->findOrFail($id);
        $data['positionInfo'] = $positionInfo;
        return view('config::hrm.position.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $positionInfo = $this->Position->findOrFail($id);
        if($request->isMethod('put')){
            try{
                $params = $request->all();
                $params['updated_id'] = $this->getAdmin()->id;
                $positionInfo->fill($params);
                $positionInfo->save();
                return $this->success('config.position.index');
            }catch (\Exception $e) {
                return $this->error('config.position.index');
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
            $positionInfo = $this->Position->findOrFail($id);
            $positionInfo->delete();
            return ['status' => true, 'msg' => 'xóa thành công "' .$positionInfo->name.'"', 'data' => []];
        }catch (\Exception $e) {
            return ['status' => false, 'msg' => 'Có lỗi xảy ra vui lòng thực hiện lại', 'data' => []];
        }
    }
}
