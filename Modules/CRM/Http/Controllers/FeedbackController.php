<?php

namespace Modules\CRM\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\CRM\Entities\CrmCustomer;
use Modules\CRM\Entities\CrmFeedback;
use Modules\CRM\Http\Requests\CrmFeedbackRequest;
use Modules\CRM\Services\FeedbackService;
use Yajra\DataTables\DataTables;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param Request $request
     * @param FeedbackService $service
     * @return Renderable
     */
    public function index(Request $request, FeedbackService $service)
    {
        $columns = ['id', 'name'];
        $customers = CrmCustomer::all($columns);

        $filters = $request->only('customer_id', 'content');
        $lists = [];
        if ( !empty($filters) ) {
            $lists = $service->lists($filters);
        }
        return view('crm::feedback.index', compact('lists', 'filters', 'customers'));
    }

    /**
     * @param $saleId
     * @return mixed
     * @throws \Exception
     */
    public function datatable($saleId)
    {
        $feedback = CrmFeedback::where(['sale_id' => $saleId])->select(['id', 'content', 'date']);
        return DataTables::of($feedback)
            ->addColumn('action', function ($item) {
                return '<a href="javascript:void(0)" data-href="' . route('crm.feedback.delete', $item->id) . '" class="btn btn-xs btn-danger btn-remove"><i class="fa fa-times"></i> Delete</a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('crm::feedback');
    }

    /**
     * Store a newly created resource in storage.
     * @param CrmFeedbackRequest $request
     * @return Renderable
     */
    public function store(CrmFeedbackRequest $request)
    {
        $data = $request->validated();
        if (CrmFeedback::create($data)) {
            return response()->json(['code' => 200]);
        }
        return response()->json(['code' => 400], 400);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('crm::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('crm::edit');
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
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id)
    {
        $item = CrmFeedback::find($id);
        if ($item && $item->delete()) {
            return response()->json(['code' => 200]);
        }
        return response()->json(['code' => 400], 400);
    }
}
