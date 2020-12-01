<?php

namespace Modules\CRM\Entities;

class CrmSaleDetail extends CrmModel
{
    protected $fillable = [
        'sale_id',
        'product_id',
        'money_min',
        'money_max',
        'money_real',
        'quantity',
        'total_money_min',
        'total_money_max',
        'total_money_real',
        'created_id',
        'updated_id',
        'available'
    ];

    /**
     * CrmContact constructor.
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        self::$isCreateCode = false;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(CrmProduct::class, 'product_id');
    }
}
