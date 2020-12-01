<?php
/**
 * Created by PhpStorm.
 * User: hcenter
 * Date: 10/12/20
 * Time: 23:42
 */

namespace Modules\CRM\Services;


use Illuminate\Support\Arr;
use Modules\CRM\Entities\CrmPayment;

class PaymentService
{
    /**
     * @param array $filters
     * @return mixed
     */
    public function lists(array $filters)
    {
        $service = new SupportQuery();

        $model = CrmPayment::with(['paymentType', 'status', 'customer']);
        $model = $service->applyWhere($model, Arr::get($filters, 'payment_type_id'), 'payment_type_id');
        $model = $service->applyWhere($model, Arr::get($filters, 'status_id'), 'status_id');
        $model = $service->applyWhere($model, Arr::get($filters, 'customer_id'), 'customer_id');
        $model = $service->applyLike($model, Arr::get($filters, 'description'), ['description']);

        return $model->get();
    }
}