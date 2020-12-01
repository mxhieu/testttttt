<?php

namespace Modules\CRM\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CrmModel extends Model
{
    use SoftDeletes;

    protected static $prefixCode = '';

    protected static $isCreateCode = true;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($query) {
            $query->created_id = auth()->id();
            if (self::$isCreateCode) {
                $query->code = self::generateCode();
            }
        });

        static::saving(function ($query) {
            $query->updated_id = auth()->id();
        });
    }

    /**
     * @return string
     * @throws \Exception
     */
    public static function generateCode()
    {
        $random = random_int(001, 999);
        do{
            $code = self::$prefixCode . sprintf("%s%'.03d", date('ymd'), $random);
            $random = random_int(001, 999);
        }while (self::where('code', $code)->first());
        return $code;
    }
}
