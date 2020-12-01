<?php

namespace Modules\CRM\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Modules\Config\Entities\Company;
use Modules\Config\Entities\Status;
use Modules\Config\Helpers\ConfigHelper;
use Modules\CRM\Entities\CrmCustomer;
use Modules\CRM\Entities\CrmProduct;
use Modules\CRM\Entities\CrmProductDelivery;
use Modules\CRM\Entities\CrmSale;
use Modules\CRM\Http\Requests\CrmSaleDetailRequest;
use Modules\CRM\Http\Requests\CrmSaleRequest;
use Modules\CRM\Services\SaleService;
use Modules\CRM\Helpers\CRMConfigHelper;

class SaleController extends BaseController
{
    /**
     * Display a listing of the resource.
     * @param Request $request
     * @param SaleService $service
     * @return Renderable
     */
    public function index(Request $request, SaleService $service)
    {
        $columns = ['id', 'name'];
        $customers = CrmCustomer::all($columns);
        $statuses = Status::all($columns);
        $kinds = CRMConfigHelper::getData(config('crm.config.sale.kind'));

        $filters = $request->only('name', 'customer_id', 'status_id', 'kind_id');
        $lists = [];
        if ( !empty($filters) ) {
            $lists = $service->lists($filters);
        }
        return view('crm::sale.index', compact('lists', 'filters', 'customers', 'statuses', 'kinds'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $columns = ['id', 'name'];
        $customers = CrmCustomer::all($columns);
        $statuses = Status::all($columns);
        $kinds = CRMConfigHelper::getData(config('crm.config.sale.kind'));

        return view('crm::sale.form', compact('customers', 'statuses', 'kinds'));
    }

    /**
     * @param CrmSaleRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CrmSaleRequest $request)
    {
        $data = $request->validated();
        if (CrmSale::create($data)) {
            return $this->success('crm.sales.index');
        }
        return back()->withInput($data);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $data = CrmSale::find($id);
        $details = $data->details;
        $detailDeliveries = $details->where('available', '>', 0);
        $columns = ['id', 'name', 'sold', 'totalQuantity'];

        // product
        if ($details) {
            $productIds = $details->pluck('product_id')->toArray();
            $products = CrmProduct::whereNotIn('id', $productIds)->get($columns);
        }else{
            $products = CrmProduct::all($columns);
        }

        $paymentTypes = ConfigHelper::getData(config('config.finance.paymentType'));
        $statuses = Status::all(['id', 'name']);

        //Tìm sản phẩm đã đc delovery trong phiếu bán hàng
        $deliveries = $data->deliveries->pluck('id')->toArray();
        $productInDeliveries = CrmProductDelivery::whereIn('delivery_id', $deliveries)->pluck('product_id')->toArray();
        return view('crm::sale.show', compact(
            'data',
            'products',
            'details',
            'paymentTypes',
            'statuses',
            'detailDeliveries',
            'productInDeliveries'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $data = CrmSale::find($id);
        $columns = ['id', 'name'];
        $customers = CrmCustomer::all($columns);
        $statuses = Status::all(['id', 'name']);
        $kinds = CRMConfigHelper::getData(config('crm.config.sale.kind'));

        return view('crm::sale.form', compact('data','customers', 'statuses', 'kinds'));
    }

    /**
     * @param CrmSaleRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(CrmSaleRequest $request, $id)
    {
        $data = $request->validated();
        $item = CrmSale::find($id);
        if ($item->update($data)) {
            return $this->success('crm.sales.index');
        }
        return back()->withInput($data);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $item = CrmSale::find($id);
        if ($item && $item->delete()) {
            return $this->success('crm.sales.index');
        }
        return $this->error('crm.sales.index');
    }

    /**
     * @param CrmSaleDetailRequest $request
     * @param SaleService $service
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeDetail(CrmSaleDetailRequest $request, SaleService $service)
    {
        if ($service->storeDetail($request)) {
            return response()->json(['code' => 200]);
        }
        return response()->json(['code' => 400], 400);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function invoice($id)
    {
        $data = CrmSale::find($id);
        $company = Company::first();
        return view('crm::sale.invoice', compact(
            'data',
            'company'
        ));
    }
}
