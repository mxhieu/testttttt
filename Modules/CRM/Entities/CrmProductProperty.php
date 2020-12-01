<?php

namespace Modules\CRM\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Config\Entities\ConfigMoneyUnit;
use Modules\Config\Entities\ConfigProductUnit;

class CrmProductProperty extends Model
{
    protected $fillable = [
        'product_id', 'type', 'min', 'max', 'unit_id'
    ];

    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function moneyUnit()
    {
        return $this->belongsTo(ConfigMoneyUnit::class, 'unit_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function quantityUnit()
    {
        return $this->belongsTo(ConfigProductUnit::class, 'unit_id');
    }
}
