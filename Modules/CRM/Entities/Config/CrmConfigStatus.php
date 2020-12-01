<?php

namespace Modules\CRM\Entities\Config;


use Modules\CRM\Entities\CrmModel;

class CrmConfigStatus extends CrmModel
{
    public $isColor = true;

    protected $fillable = [
        'name', 'code', 'sort', 'created_id', 'updated_id', 'color'
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        self::$prefixCode = 'CRM-STATUS-';
        self::$isCreateCode = true;
    }
}
