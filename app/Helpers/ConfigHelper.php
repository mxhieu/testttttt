<?php
/**
 * Created by PhpStorm.
 * User: hcenter
 * Date: 9/11/20
 * Time: 14:05
 */

namespace App\Helpers;

use App\Models\Config\ConfigMoneyUnit;
use App\Models\Config\ConfigPaymentType;
use App\Models\Config\ConfigProductColor;
use App\Models\Config\ConfigProductGroup;
use App\Models\Config\ConfigProductKind;
use App\Models\Config\ConfigProductQuality;
use App\Models\Config\ConfigProductType;
use App\Models\Config\ConfigProductUnit;

class ConfigHelper
{
    /**
     * @param null $resource
     * @return mixed
     */
    public static function getModel($resource = null) {
        if (!$resource) return abort(404);

        switch ($resource) {
            case config('eoffice.product.kind'):
                return new ConfigProductKind();
            case config('eoffice.product.type'):
                return new ConfigProductType();
            case config('eoffice.product.group'):
                return new ConfigProductGroup();
            case config('eoffice.product.color'):
                return new ConfigProductColor();
            case config('eoffice.product.unit'):
                return new ConfigProductUnit();
            case config('eoffice.product.quality'):
                return new ConfigProductQuality();
            case config('eoffice.common.moneyUnit'):
                return new ConfigMoneyUnit();
            case config('eoffice.common.paymentType'):
                return new ConfigPaymentType();
            default:
                return abort(404);
        }
    }

    /**
     * @param $resource
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getData($resource)
    {
        $columns = ['id', 'name'];
        switch ($resource) {
            case config('eoffice.product.kind'):
                return ConfigProductKind::all($columns);
            case config('eoffice.product.type'):
                return ConfigProductType::all();
            case config('eoffice.product.group'):
                return ConfigProductGroup::all($columns);
            case config('eoffice.product.color'):
                return ConfigProductColor::all($columns);
            case config('eoffice.product.unit'):
                return ConfigProductUnit::all($columns);
            case config('eoffice.product.quality'):
                return ConfigProductQuality::all($columns);
            case config('eoffice.common.moneyUnit'):
                return ConfigMoneyUnit::all($columns);
            case config('eoffice.common.paymentType'):
                return ConfigPaymentType::all($columns);
            default:
                return collect([]);
        }
    }
}