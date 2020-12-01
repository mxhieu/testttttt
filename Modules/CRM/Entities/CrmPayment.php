<?php

namespace Modules\CRM\Entities;


use Modules\Config\Entities\ConfigFinanceStatus;
use Modules\Config\Entities\ConfigPaymentType;
use Modules\Config\Entities\Status;

class CrmPayment extends CrmModel
{
    protected $fillable = [
        'sale_id', 'status_id', 'payment_type_id', 'money', 'note', 'created_id', 'updated_id', 'date', 'customer_id', 'description'
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
    public function paymentType()
    {
        return $this->belongsTo(ConfigPaymentType::class, 'payment_type_id');
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
}
