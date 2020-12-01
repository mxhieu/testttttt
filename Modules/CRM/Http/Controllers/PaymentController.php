<?php

namespace Modules\CRM\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Config\Entities\Status;
use Modules\Config\Helpers\ConfigHelper;
use Modules\CRM\Entities\CrmCustomer;
use Modules\CRM\Entities\CrmPayment;
use Modules\CRM\Http\Requests\CrmPaymentRequest;
use Modules\CRM\Services\PaymentService;
use Yajra\DataTables\DataTables;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param Request $request
     * @param PaymentService $service
     * @return Renderable
     */
    public function index(Request $request, PaymentService $service)
    {
        $columns = ['id', 'name'];
        $customers = CrmCustomer::all($columns);
        $statuses = Status::all($columns);
        $paymentTypes = ConfigHelper::getData(config('config.finance.paymentType'));

        $filters = $request->only('payment_type_id', 'customer_id', 'status_id', 'description');
        $lists = [];
        if ( !empty($filters) ) {
            $lists = $service->lists($filters);
        }
        return view('crm::payment.index', compact('lists', 'filters', 'customers', 'statuses', 'paymentTypes'));
    }

    /**
     * @param $saleId
     * @return mixed
     * @throws \Exception
     */
    public function datatable($saleId)
    {
        $payments = CrmPayment::where(['sale_id' => $saleId])->select(['id', 'status_id', 'payment_type_id', 'money', 'note', 'date', 'description']);
        return DataTables::of($payments)
            ->editColumn('status_id', function ($payment) {
                return view('crm::components.td_color', ['data' => $payment->status]);
            })
            ->editColumn('payment_type_id', function ($payment) {
                return $payment->paymentType->name;
            })
            ->addColumn('action', function ($payment) {
                return '<a href="javascript:void(0)" data-href="' . route('crm.payments.delete', $payment->id) . '" class="btn btn-xs btn-danger btn-remove"><i class="fa fa-times"></i> Delete</a>';
            })
            ->rawColumns(['status_id', 'action', 'payment_type_id'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('crm::payment.form');
    }

    /**
     * Store a newly created resource in storage.
     * @param CrmPaymentRequest $request
     * @return Renderable
     */
    public function store(CrmPaymentRequest $request)
    {
        $data = $request->validated();
        if (CrmPayment::create($data)) {
            return response()->json(['code' => 200]);
        }
        return response()->json(['code' => 400], 400);
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

    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id)
    {
        $item = CrmPayment::find($id);
        if ($item && $item->delete()) {
            return response()->json(['code' => 200]);
        }
        return response()->json(['code' => 400], 400);
    }
}
