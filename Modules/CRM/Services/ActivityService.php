<?php
/**
 * Created by PhpStorm.
 * User: hcenter
 * Date: 10/12/20
 * Time: 23:42
 */

namespace Modules\CRM\Services;


use Illuminate\Support\Arr;
use Modules\CRM\Entities\CrmActivity;

class ActivityService
{
    /**
     * @param array $filters
     * @return mixed
     */
    public function lists(array $filters)
    {
        $service = new SupportQuery();

        $model = CrmActivity::with(['group', 'status', 'customer', 'status', 'type', 'kind']);
        $model = $service->applyWhere($model, Arr::get($filters, 'group_id'), 'group_id');
        $model = $service->applyWhere($model, Arr::get($filters, 'status_id'), 'status_id');
        $model = $service->applyWhere($model, Arr::get($filters, 'type_id'), 'type_id');
        $model = $service->applyWhere($model, Arr::get($filters, 'kind_id'), 'kind_id');
        $model = $service->applyWhere($model, Arr::get($filters, 'customer_id'), 'customer_id');
        $model = $service->applyLike($model, Arr::get($filters, 'name'), ['name']);

        return $model->get();
    }

    /**
     * @param array $filters
     * @return mixed
     */
    public function granttData(array $filters)
    {
        $service = new SupportQuery();

        $model = CrmActivity::with(['customer']);
        $model = $service->applyWhere($model, Arr::get($filters, 'customer_id'), 'customer_id');
        $model = $service->applyWhere($model, Arr::get($filters, 'group_id'), 'group_id');
        $model = $service->applyWhere($model, Arr::get($filters, 'status_id'), 'status_id');
        $model = $service->applyWhere($model, Arr::get($filters, 'type_id'), 'type_id');
        $model = $service->applyWhere($model, Arr::get($filters, 'kind_id'), 'kind_id');
        $model = $service->applyWhere($model, Arr::get($filters, 'customer_id'), 'customer_id');
        $model = $service->applyLike($model, Arr::get($filters, 'name'), ['name']);

        return $model->get();
    }
}