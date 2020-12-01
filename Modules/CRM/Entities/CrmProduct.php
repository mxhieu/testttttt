<?php

namespace Modules\CRM\Entities;


use Modules\Config\Entities\ConfigProductColor;
use Modules\Config\Entities\ConfigProductGroup;
use Modules\Config\Entities\ConfigProductKind;
use Modules\Config\Entities\ConfigProductType;

class CrmProduct extends CrmModel
{
    protected $fillable = [
        'images',
        'files',
        'name',
        'code',
        'type_id',
        'kind_id',
        'group_id',
        'color_id',
        'description',
        'sold',
        'created_id',
        'updated_id',
        'totalQuantity'
    ];

    protected $casts = [
        'images' => 'array',
        'files' => 'array',
        'sold' => 'int',
        'totalQuantity' => 'int'
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        self::$isCreateCode = true;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function kind()
    {
        return $this->belongsTo(ConfigProductKind::class, 'kind_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function group()
    {
        return $this->belongsTo(ConfigProductGroup::class, 'group_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type()
    {
        return $this->belongsTo(ConfigProductType::class, 'type_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function color()
    {
        return $this->belongsTo(ConfigProductColor::class, 'color_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function nature()
    {
        return $this->hasOne(CrmProductNature::class, 'product_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function property()
    {
        return $this->hasMany(CrmProductProperty::class, 'product_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function quality()
    {
        return $this->hasMany(CrmProductQuality::class, 'product_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function money()
    {
        return $this->hasOne(CrmProductProperty::class, 'product_id')->where(['type' => 'money']);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function quantity()
    {
        return $this->hasOne(CrmProductProperty::class, 'product_id')->where(['type' => 'quantity']);
    }

    public function getAvailableAttribute()
    {
        return $this->totalQuantity - $this->sold;
    }
}
