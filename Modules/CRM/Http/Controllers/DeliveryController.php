<?php

namespace Modules\CRM\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Arr;
use Modules\Config\Entities\Status;
use Modules\CRM\Entities\CrmCustomer;
use Modules\CRM\Entities\CrmDelivery;
use Modules\CRM\Entities\CrmProduct;
use Modules\CRM\Entities\CrmProductDelivery;
use Modules\CRM\Http\Requests\CrmDeliveryRequest;
use Modules\CRM\Services\DeliveryService;
use Yajra\DataTables\DataTables;

class DeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param Request $request
     * @param DeliveryService $service
     * @return Renderable
     */
    public function index(Request $request, DeliveryService $service)
    {
        $columns = ['id', 'name'];
        $customers = CrmCustomer::all($columns);
        $columns = ['id', 'name'];
        $statuses = Status::all($columns);
        $products = CrmProduct::all($columns);

        $filters = $request->only('product_id', 'customer_id', 'status_id', 'address');
        $lists = [];
        if ( !empty($filters) ) {
            $lists = $service->lists($filters);
        }
        return view('crm::delivery.index', compact('lists', 'filters', 'customers', 'statuses', 'products'));
    }

    /**
     * @param $saleId
     * @return mixed
     * @throws \Exception
     */
    public function datatable($saleId)
    {
        $deliveries = CrmDelivery::where(['sale_id' => $saleId])->select(['id', 'status_id', 'note', 'date', 'address']);
        return DataTables::of($deliveries)
            ->editColumn('status_id', function ($delivery) {
                return view('crm::components.td_color', ['data' => $delivery->status]);
            })
            ->addColumn('products', function ($delivery) {
                $products = [];
                foreach ($delivery->products as $product) {
                    $products[] = $product->product->name . ' - ' . $product->quantity;
                }
                return implode(', ', $products);
            })
            ->addColumn('action', function ($delivery) {
                return '<a href="javascript:void(0)" data-href="' . route('crm.deliveries.delete', $delivery->id) . '" class="btn btn-xs btn-danger btn-remove"><i class="fa fa-times"></i> Delete</a>';
            })
            ->rawColumns(['status_id', 'action', 'products'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('crm::delivery.form');
    }

    /**
     * Store a newly created resource in storage.
     * @param CrmDeliveryRequest $request
     * @return Renderable
     */
    public function store(CrmDeliveryRequest $request)
    {
        $data = $request->only('sale_id', 'status_id', 'address', 'note', 'date', 'customer_id');
        if ($delivery = CrmDelivery::create($data)) {
            $products = $request->products;
            foreach ($products as $item) {
                $product_id = Arr::get($item, 'product_id');
                $quantity = Arr::get($item, 'quantity');
                if ($product_id && $quantity) {
                    $dataProduct = [
                        'product_id' => $product_id,
                        'quantity' => $quantity,
                        'delivery_id' => $delivery->id
                    ];
                    CrmProductDelivery::create($dataProduct);
                }

            }
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
        $item = CrmDelivery::find($id);
        if ($item && $item->delete()) {
            CrmProductDelivery::where(['delivery_id' => $id])->delete();
            return response()->json(['code' => 200]);
        }
        return response()->json(['code' => 400], 400);
    }
}
