<?php

namespace Modules\CRM\Entities;

use Illuminate\Database\Eloquent\Model;

class CrmProductNature extends Model
{
    protected $fillable = [
        'product_id','width','height','length','unit_id'
    ];

    public $timestamps = false;
}
