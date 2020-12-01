<?php
/**
 * Created by PhpStorm.
 * User: hcenter
 * Date: 10/3/20
 * Time: 13:01
 */

namespace Modules\CRM\Observers;


use Modules\CRM\Entities\CrmProduct;
use Modules\CRM\Entities\CrmSaleDetail;

class SaleDetailObserver
{
    /**
     * Sau khi tạo mới 1 chi tiết phiếu bán hàng,tiến hành trừ số lượng sp
     *
     * @param CrmSaleDetail $saleDetail
     */
    public function created(CrmSaleDetail $saleDetail)
    {
        $product = CrmProduct::find($saleDetail->product_id);
        $product->sold = $product->sold + $saleDetail->quantity;
        $product->save();
    }

    /**
     * @param CrmSaleDetail $saleDetail
     */
    public function deleted(CrmSaleDetail $saleDetail)
    {
        $product = CrmProduct::find($saleDetail->product_id);
        $product->available = $product->sold - $saleDetail->quantity;
        $product->save();
    }
}