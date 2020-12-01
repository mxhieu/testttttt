<?php

namespace Modules\CRM\Entities;


class CrmFeedback extends CrmModel
{
    protected $fillable = [
        'customer_id', 'sale_id', 'content', 'date', 'created_id', 'updated_id'
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
    public function sale()
    {
        return $this->belongsTo(CrmSale::class, 'sale_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer()
    {
        return $this->belongsTo(CrmCustomer::class, 'customer_id');
    }
}
