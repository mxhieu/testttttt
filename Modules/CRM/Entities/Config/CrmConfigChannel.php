<?php

namespace Modules\CRM\Entities\Config;

use Illuminate\Database\Eloquent\Model;
use Modules\CRM\Entities\CrmModel;

class CrmConfigChannel extends CrmModel
{
    public $isColor = true;

    protected $fillable = [
        'name', 'code', 'sort', 'created_id', 'updated_id', 'color'
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        self::$prefixCode = 'CRM-CHANNEL-';
        self::$isCreateCode = true;
    }
}
