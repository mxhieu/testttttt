<?php
/**
 * Created by PhpStorm.
 * User: hcenter
 * Date: 10/3/20
 * Time: 13:01
 */

namespace Modules\CRM\Observers;


use Modules\CRM\Entities\CrmDelivery;
use Modules\CRM\Entities\CrmProductDelivery;
use Modules\CRM\Entities\CrmSaleDetail;

class ProductDeliveryObserver
{
    /**
     * Sau khi tạo mới 1 chi tiết phiếu bán hàng,tiến hành trừ số lượng sp
     *
     * @param CrmProductDelivery $productDelivery
     */
    public function created(CrmProductDelivery $productDelivery)
    {
        $delivery = CrmDelivery::find($productDelivery->delivery_id);
        if ($delivery) {
            $whereDetail = [
                'product_id' => $productDelivery->product_id,
                'sale_id' => $delivery->sale_id
            ];
            $saleDetail = CrmSaleDetail::where($whereDetail)->first();
            if ($saleDetail) {
                $saleDetail->available = $saleDetail->available - $productDelivery->quantity;
                $saleDetail->save();
            }
        }

    }

    /**
     * @param CrmProductDelivery $productDelivery
     */
    public function deleted(CrmProductDelivery $productDelivery)
    {
        $delivery = CrmDelivery::find($productDelivery->delivery_id);
        if ($delivery) {
            $whereDetail = [
                'product_id' => $productDelivery->product_id,
                'sale_id' => $delivery->sale_id
            ];
            $saleDetail = CrmSaleDetail::where($whereDetail)->first();
            if ($saleDetail) {
                $saleDetail->available = $saleDetail->available + $productDelivery->quantity;
                $saleDetail->save();
            }
        }
    }
}