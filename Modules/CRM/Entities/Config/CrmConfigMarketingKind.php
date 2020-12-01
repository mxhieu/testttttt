<?php

namespace Modules\CRM\Entities\Config;


use Modules\CRM\Entities\CrmModel;

class CrmConfigMarketingKind extends CrmModel
{
    protected $fillable = [
        'name', 'code', 'sort', 'created_id', 'updated_id'
    ];

    /**
     * CrmConfigMarketingKind constructor.
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        self::$prefixCode = 'CRM-MARKETING-KIND-';
        self::$isCreateCode = true;
    }
}
