<?php
/**
 * Created by PhpStorm.
 * User: hcenter
 * Date: 10/12/20
 * Time: 23:42
 */

namespace Modules\CRM\Services;


use Illuminate\Support\Arr;
use Modules\CRM\Entities\CrmMarketing;

class MarketingService
{
    /**
     * @param array $filters
     * @return mixed
     */
    public function lists(array $filters)
    {
        $service = new SupportQuery();

        $model = CrmMarketing::with(['kind', 'group', 'type', 'userGroup']);
        $model = $service->applyWhere($model, Arr::get($filters, 'kind_id'), 'kind_id');
        $model = $service->applyWhere($model, Arr::get($filters, 'user_group_id'), 'user_group_id');
        $model = $service->applyWhere($model, Arr::get($filters, 'in_charge_id'), 'in_charge_id');
        $model = $service->applyWhere($model, Arr::get($filters, 'type_id'), 'type_id');
        $model = $service->applyWhere($model, Arr::get($filters, 'group_id'), 'group_id');
        $model = $service->applyLike($model, Arr::get($filters, 'name'), ['name']);

        return $model->get();
    }
}