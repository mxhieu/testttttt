<?php

namespace Modules\CRM\Entities;


use Modules\Config\Entities\Status;
use Modules\CRM\Entities\Config\CrmConfigActivityGroup;
use Modules\CRM\Entities\Config\CrmConfigActivityKind;
use Modules\CRM\Entities\Config\CrmConfigActivityType;
use Modules\CRM\Entities\Config\CrmConfigStatus;

class CrmActivity extends CrmModel
{
    protected $fillable = [
        'customer_id',
        'name',
        'code',
        'remark',
        'start_at',
        'end_at',
        'complete',
        'kind_id',
        'type_id',
        'group_id',
        'status_id',
        'created_id',
        'updated_id'
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        self::$prefixCode = 'CRM-ACTIVITY-';
        self::$isCreateCode = true;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function kind()
    {
        return $this->belongsTo(CrmConfigActivityKind::class, 'kind_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function group()
    {
        return $this->belongsTo(CrmConfigActivityGroup::class, 'group_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type()
    {
        return $this->belongsTo(CrmConfigActivityType::class, 'type_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer()
    {
        return $this->belongsTo(CrmCustomer::class, 'customer_id');
    }
}
