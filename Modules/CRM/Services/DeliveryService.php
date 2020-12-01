<?php
/**
 * Created by PhpStorm.
 * User: hcenter
 * Date: 10/12/20
 * Time: 23:42
 */

namespace Modules\CRM\Services;


use Illuminate\Support\Arr;
use Modules\CRM\Entities\CrmDelivery;
use Modules\CRM\Entities\CrmProductDelivery;

class DeliveryService
{
    /**
     * @param array $filters
     * @return mixed
     */
    public function lists(array $filters)
    {
        $service = new SupportQuery();

        $model = CrmDelivery::with(['products', 'status', 'customer']);
        $model = $service->applyWhere($model, Arr::get($filters, 'status_id'), 'status_id');
        $model = $service->applyWhere($model, Arr::get($filters, 'customer_id'), 'customer_id');
        $model = $service->applyLike($model, Arr::get($filters, 'address'), ['address']);

        $productIds = $this->findDeliveryIdsByProduct(Arr::get($filters, 'product_id'));
        if (!empty($productIds)) {
            $model = $model->whereIn('id', $productIds);
        }

        return $model->get();
    }

    /**
     * @param $productId
     * @return array
     */
    private function findDeliveryIdsByProduct($productId): array
    {
        if ($productId) {
            return CrmProductDelivery::where(['product_id' => $productId])->get('delivery_id')->pluck('delivery_id')->toArray();
        }
        return [];
    }
}