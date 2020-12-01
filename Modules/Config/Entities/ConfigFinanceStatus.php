<?php

namespace Modules\Config\Entities;

class ConfigFinanceStatus extends BaseConfigModel
{
    public $isColor = true;
    protected $fillable = [
        'name', 'code', 'sort', 'created_id', 'updated_id', 'color'
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        self::$prefixCode = 'FINANCE-STATUS-';
    }
}
