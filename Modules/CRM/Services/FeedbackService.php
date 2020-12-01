<?php
/**
 * Created by PhpStorm.
 * User: hcenter
 * Date: 10/12/20
 * Time: 23:42
 */

namespace Modules\CRM\Services;


use Illuminate\Support\Arr;
use Modules\CRM\Entities\CrmFeedback;

class FeedbackService
{
    /**
     * @param array $filters
     * @return mixed
     */
    public function lists(array $filters)
    {
        $service = new SupportQuery();

        $model = CrmFeedback::with(['customer']);
        $model = $service->applyWhere($model, Arr::get($filters, 'customer_id'), 'customer_id');
        $model = $service->applyLike($model, Arr::get($filters, 'content'), ['content']);

        return $model->get();
    }
}