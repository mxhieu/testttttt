<?php

namespace Modules\CRM\Entities;

use Illuminate\Database\Eloquent\Model;

class CrmProductDelivery extends Model
{
    protected $fillable = [
        'product_id', 'delivery_id', 'quantity', 'sale_id'
    ];

    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(CrmProduct::class, 'product_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function delivery()
    {
        return $this->belongsTo(CrmDelivery::class, 'delivery_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sale()
    {
        return $this->belongsTo(CrmSale::class, 'sale_id');
    }
}
