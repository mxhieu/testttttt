<?php

namespace Modules\CRM\Entities\Config;


use Modules\CRM\Entities\CrmModel;

class CrmConfigCustomerGroup extends CrmModel
{
    protected $fillable = [
        'name', 'code', 'sort', 'created_id', 'updated_id'
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        self::$prefixCode = 'CRM-CUSTOMER-GROUP-';
        self::$isCreateCode = true;
    }
}
