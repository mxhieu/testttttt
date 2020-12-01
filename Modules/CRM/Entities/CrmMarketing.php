<?php

namespace Modules\CRM\Entities;


use App\User;
use Modules\Config\Entities\Employee;
use Modules\Config\Entities\EmployeeGroup;
use Modules\CRM\Entities\Config\CrmConfigMarketingGroup;
use Modules\CRM\Entities\Config\CrmConfigMarketingKind;
use Modules\CRM\Entities\Config\CrmConfigMarketingType;

class CrmMarketing extends CrmModel
{
    protected $fillable = [
        'name',
        'code',
        'remark',
        'files',
        'start_at',
        'end_at',
        'user_group_id',
        'in_charge_id',
        'kind_id',
        'type_id',
        'group_id',
        'created_id',
        'updated_id'
    ];

    protected $casts = [
        'files' => 'array'
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        self::$prefixCode = 'CRM-MARKETING-';
        self::$isCreateCode = true;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function group()
    {
        return $this->belongsTo(CrmConfigMarketingGroup::class, 'group_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function kind()
    {
        return $this->belongsTo(CrmConfigMarketingKind::class, 'kind_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type()
    {
        return $this->belongsTo(CrmConfigMarketingType::class, 'type_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function userGroup()
    {
        return $this->belongsTo(EmployeeGroup::class, 'user_group_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function inCharge()
    {
        return $this->belongsTo(Employee::class, 'in_charge_id');
    }
}
