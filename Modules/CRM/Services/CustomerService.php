<?php
/**
 * Created by PhpStorm.
 * User: hcenter
 * Date: 10/12/20
 * Time: 23:42
 */

namespace Modules\CRM\Services;


use Illuminate\Support\Arr;
use Modules\CRM\Entities\CrmCustomer;

class CustomerService
{
    /**
     * @param array $filters
     * @return mixed
     */
    public function lists(array $filters)
    {
        $service = new SupportQuery();

        $model = CrmCustomer::with(['market', 'kind', 'group', 'type', 'channel', 'relation']);
        $model = $service->applyWhere($model, Arr::get($filters, 'market_id'), 'market_id');
        $model = $service->applyWhere($model, Arr::get($filters, 'kind_id'), 'kind_id');
        $model = $service->applyWhere($model, Arr::get($filters, 'channel_id'), 'channel_id');
        $model = $service->applyWhere($model, Arr::get($filters, 'relation_id'), 'relation_id');
        $model = $service->applyWhere($model, Arr::get($filters, 'type_id'), 'type_id');
        $model = $service->applyWhere($model, Arr::get($filters, 'group_id'), 'group_id');
        $model = $service->applyLike($model, Arr::get($filters, 'name'), ['name']);
        $model = $service->applyLike($model, Arr::get($filters, 'phone'), ['phone']);

        return $model->get();
    }
}