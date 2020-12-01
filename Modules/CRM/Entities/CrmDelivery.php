<?php

namespace Modules\CRM\Entities;


use Modules\Config\Entities\Status;
use Modules\CRM\Entities\Config\CrmConfigStatus;

class CrmDelivery extends CrmModel
{
    protected $fillable = [
        'customer_id', 'sale_id', 'status_id', 'address', 'date', 'created_id', 'updated_id', 'note'
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
    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer()
    {
        return $this->belongsTo(CrmCustomer::class, 'customer_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany(CrmProductDelivery::class, 'delivery_id');
    }
}
