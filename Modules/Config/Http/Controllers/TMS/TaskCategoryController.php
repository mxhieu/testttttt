<?php

namespace Modules\Config\Http\Controllers\TMS;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Modules\Config\Entities\TaskCategory;
use Modules\Config\Http\Controllers\BaseController;
use Yajra\Datatables\Datatables;

class TaskCategoryController extends BaseController
{

    protected $TaskCategory;
    
    public function __construct(TaskCategory $TaskCategory){
        $this->TaskCategory = $TaskCategory;
    }

    public function taskCategoryData(){
        $taskCategoryList = $this->TaskCategory->getAll();
        return Datatables::of($taskCategoryList)
        ->addColumn('action', function ($taskCategoryList) {
            return '<a href="'.route('config.taskcategory.edit', $taskCategoryList->id).'" class="btn btn-xs btn-warning">
                        <i class="fa fa-eye"></i> View</a>
                    <a href="javascript:void(0)" data-link="'.route('config.taskcategory.destroy', $taskCategoryList->id). '" class="btn btn-xs btn-danger btn-delete">
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
        return view('config::tms.taskcategory.index');
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
            $this->TaskCategory->create($params);
            return $this->success('config.taskcategory.index');
        }catch (\Exception $e) {
            return $this->error('config.taskcategory.index');
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
        $taskCategoryInfo = $this->TaskCategory->findOrFail($id);
        $data['taskCategoryInfo'] = $taskCategoryInfo;
        return view('config::tms.taskcategory.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $taskCategoryInfo = $this->TaskCategory->findOrFail($id);
        if($request->isMethod('put')){
            try{
                $params = $request->all();
                $params['updated_id'] = $this->getAdmin()->id;
                $taskCategoryInfo->fill($params);
                $taskCategoryInfo->save();
                return $this->success('config.taskcategory.index');
            }catch (\Exception $e) {
                return $this->error('config.taskcategory.index');
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
            $taskCategoryInfo = $this->TaskCategory->findOrFail($id);
            $taskCategoryInfo->delete();
            return ['status' => true, 'msg' => 'xóa thành công "' .$taskCategoryInfo->name.'"', 'data' => []];
        }catch (\Exception $e) {
            return ['status' => false, 'msg' => 'Có lỗi xảy ra vui lòng thực hiện lại', 'data' => []];
        }
    }
}
