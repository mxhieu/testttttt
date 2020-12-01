<?php

namespace Modules\Config\Http\Controllers\TMS;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Modules\Config\Entities\TaskPhrase;
use Modules\Config\Http\Controllers\BaseController;
use Yajra\Datatables\Datatables;

class TaskPhraseController extends BaseController
{

    protected $TaskPhrase;
    
    public function __construct(TaskPhrase $TaskPhrase){
        $this->TaskPhrase = $TaskPhrase;
    }

    public function taskPhraseData(){
        $taskPhraseList = $this->TaskPhrase->getAll();
        return Datatables::of($taskPhraseList)
        ->addColumn('action', function ($taskPhraseList) {
            return '<a href="'.route('config.taskphrase.edit', $taskPhraseList->id).'" class="btn btn-xs btn-warning">
                        <i class="fa fa-eye"></i> View</a>
                    <a href="javascript:void(0)" data-link="'.route('config.taskphrase.destroy', $taskPhraseList->id). '" class="btn btn-xs btn-danger btn-delete">
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
        return view('config::tms.taskphrase.index');
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
            $this->TaskPhrase->create($params);
            return $this->success('config.taskphrase.index');
        }catch (\Exception $e) {
            return $this->error('config.taskphrase.index');
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
        $taskPhraseInfo = $this->TaskPhrase->findOrFail($id);
        $data['taskPhraseInfo'] = $taskPhraseInfo;
        return view('config::tms.taskphrase.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $taskPhraseInfo = $this->TaskPhrase->findOrFail($id);
        if($request->isMethod('put')){
            try{
                $params = $request->all();
                $params['updated_id'] = $this->getAdmin()->id;
                $taskPhraseInfo->fill($params);
                $taskPhraseInfo->save();
                return $this->success('config.taskphrase.index');
            }catch (\Exception $e) {
                return $this->error('config.taskphrase.index');
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
            $taskPhraseInfo = $this->TaskPhrase->findOrFail($id);
            $taskPhraseInfo->delete();
            return ['status' => true, 'msg' => 'xóa thành công "' .$taskPhraseInfo->name.'"', 'data' => []];
        }catch (\Exception $e) {
            return ['status' => false, 'msg' => 'Có lỗi xảy ra vui lòng thực hiện lại', 'data' => []];
        }
    }
}
