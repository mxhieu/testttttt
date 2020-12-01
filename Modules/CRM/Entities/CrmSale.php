<?php

namespace Modules\CRM\Entities;

use Modules\Config\Entities\Status;
use Modules\CRM\Entities\Config\CrmConfigStatus;
use Modules\CRM\Entities\Config\CrmConfigSaleKind;

class CrmSale extends CrmModel
{
    protected $fillable = [
        'code',
        'name',
        'customer_id',
        'kind_id',
        'status_id',
        'start_at',
        'end_at',
        'final_money',
        'money_up',
        'money_down',
        'description',
        'total_money',
        'vat',
        'discount',
        'created_id',
        'updated_id',
        'approved_id'
    ];

    /**
     * CrmContact constructor.
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        self::$prefixCode = 'CRM-SALE-';
        self::$isCreateCode = true;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer()
    {
        return $this->belongsTo(CrmCustomer::class, 'customer_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function details()
    {
        return $this->hasMany(CrmSaleDetail::class, 'sale_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function kind()
    {
        return $this->belongsTo(CrmConfigSaleKind::class, 'kind_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function payments()
    {
        return $this->hasMany(CrmPayment::class, 'sale_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function deliveries()
    {
        return $this->hasMany(CrmDelivery::class, 'sale_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function approved()
    {
        return $this->belongsTo(CrmConfigSaleKind::class, 'approved_id');
    }
}
