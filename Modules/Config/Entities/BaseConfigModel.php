<?php
/**
 * Created by PhpStorm.
 * User: hcenter
 * Date: 9/13/20
 * Time: 16:08
 */

namespace Modules\Config\Entities;


use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class BaseConfigModel extends Model
{
    use SoftDeletes;

    protected static $prefixCode = '';

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
            $query->code = self::generateCode();
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