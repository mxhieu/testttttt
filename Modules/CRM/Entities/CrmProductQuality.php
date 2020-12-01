<?php

namespace Modules\CRM\Entities;

use Illuminate\Database\Eloquent\Model;

class CrmProductQuality extends Model
{
    protected $fillable = [
        'product_id','quality_id'
    ];

    public $timestamps = false;
}
