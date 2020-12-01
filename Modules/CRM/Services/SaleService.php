<?php
/**
 * Created by PhpStorm.
 * User: hcenter
 * Date: 9/17/20
 * Time: 22:43
 */

namespace Modules\CRM\Services;


use Illuminate\Support\Arr;
use Modules\CRM\Entities\CrmProduct;
use Modules\CRM\Entities\CrmSale;
use Modules\CRM\Entities\CrmSaleDetail;
use Modules\CRM\Http\Requests\CrmSaleDetailRequest;

class SaleService
{
    /**
     * @param array $filters
     * @return mixed
     */
    public function lists(array $filters)
    {
        $service = new SupportQuery();

        $model = CrmSale::with(['customer', 'status', 'kind']);
        $model = $service->applyWhere($model, Arr::get($filters, 'customer_id'), 'customer_id');
        $model = $service->applyWhere($model, Arr::get($filters, 'status_id'), 'status_id');
        $model = $service->applyWhere($model, Arr::get($filters, 'kind_id'), 'kind_id');
        $model = $service->applyLike($model, Arr::get($filters, 'name'), ['name']);

        return $model->get();
    }
    /**
     * @param CrmSaleDetailRequest $request
     * @return bool
     */
    public function storeDetail(CrmSaleDetailRequest $request)
    {
        try{
            $saleId = $request->sale_id;
            $sale = CrmSale::find($saleId);
            if ($sale) {
                $data = $request->only('total_money', 'money_up', 'money_down', 'final_money', 'discount', 'vat');
                $sale->update($data);

                $details = $request->data;
                // Xoá hết trc khi cập nhật
                CrmSaleDetail::where('sale_id', $saleId)->delete();
                if ($details && count($details) > 0) {
                    foreach ($details as $param) {
                        $this->updateAvailableProduct($saleId, Arr::get($param, 'product_id'));
                        $param['available'] = $param['quantity'];
                        CrmSaleDetail::create($param);
                    }
                }
                return true;
            }
        }catch (\Exception $exception) {
            logger('SaleService storeDetail errors' . $exception->getMessage());
        }
        return false;
    }

    /**
     * @param $saleId
     * @param $productId
     */
    private function updateAvailableProduct($saleId, $productId)
    {
        $detail = CrmSaleDetail::where(['sale_id' => $saleId, 'product_id' => $productId])->first();
        if ($detail) {
            $product = CrmProduct::find($productId);
            $product->available = $product->available + $detail->quantity;
            $product->save();
        }
    }
}