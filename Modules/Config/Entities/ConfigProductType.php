<?php

namespace Modules\Config\Entities;


class ConfigProductType extends BaseConfigModel
{
    protected $fillable = [
        'name', 'code', 'sort', 'created_id', 'updated_id'
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        self::$prefixCode = 'PRODUCT-TYPE-';
    }
}
