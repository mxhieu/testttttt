<?php

namespace Modules\CRM\Entities;

use App\User;
use Carbon\Carbon;
use Modules\CRM\Entities\Config\CrmConfigChannel;
use Modules\CRM\Entities\Config\CrmConfigCustomerGroup;
use Modules\CRM\Entities\Config\CrmConfigCustomerKind;
use Modules\CRM\Entities\Config\CrmConfigCustomerType;
use Modules\CRM\Entities\Config\CrmConfigMarket;
use Modules\CRM\Entities\Config\CrmConfigRelation;

class CrmCustomer extends CrmModel
{
    protected $fillable = [
        'code',
        'logo',
        'name',
        'tax_id',
        'address',
        'market_id',
        'email',
        'phone',
        'website',
        'find_at',
        'kind_id',
        'group_id',
        'type_id',
        'channel_id',
        'relation_id',
        'employee_id',
        'description',
        'created_id',
        'updated_id'
    ];

    //protected $dates = ['find_at'];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        self::$prefixCode = 'CRM-CUSTOMER-';
        self::$isCreateCode = true;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function market()
    {
        return $this->belongsTo(CrmConfigMarket::class, 'market_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function kind()
    {
        return $this->belongsTo(CrmConfigCustomerKind::class, 'kind_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function group()
    {
        return $this->belongsTo(CrmConfigCustomerGroup::class, 'group_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type()
    {
        return $this->belongsTo(CrmConfigCustomerType::class, 'type_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function channel()
    {
        return $this->belongsTo(CrmConfigChannel::class, 'channel_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function relation()
    {
        return $this->belongsTo(CrmConfigRelation::class, 'relation_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function employee()
    {
        return $this->belongsTo(User::class, 'employee_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contacts()
    {
        return $this->hasMany(CrmContact::class, 'customer_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function activities()
    {
        return $this->hasMany(CrmActivity::class, 'customer_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contracts()
    {
        return $this->hasMany(CrmSale::class, 'customer_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function deliveries()
    {
        return $this->hasMany(CrmDelivery::class, 'customer_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function payments()
    {
        return $this->hasMany(CrmPayment::class, 'customer_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function feedbacks()
    {
        return $this->hasMany(CrmFeedback::class, 'customer_id');
    }
}
