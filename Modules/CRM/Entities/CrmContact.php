<?php

namespace Modules\CRM\Entities;

use Modules\CRM\Entities\Config\CrmConfigDepartment;
use Modules\CRM\Entities\Config\CrmConfigPosition;

class CrmContact extends CrmModel
{
    protected $fillable = [
        'customer_id',
        'name',
        'email',
        'phone',
        'department_id',
        'position_id',
        'description',
        'created_id',
        'updated_id'
    ];

    /**
     * CrmContact constructor.
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        self::$isCreateCode = false;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function department()
    {
        return $this->belongsTo(CrmConfigDepartment::class, 'department_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function position()
    {
        return $this->belongsTo(CrmConfigPosition::class, 'position_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer()
    {
        return $this->belongsTo(CrmCustomer::class, 'customer_id');
    }
}
