<?php
/**
 * Created by PhpStorm.
 * User: hcenter
 * Date: 9/11/20
 * Time: 14:05
 */

namespace Modules\Config\Helpers;

use Modules\Config\Entities\ConfigFinanceStatus;
use Modules\Config\Entities\ConfigMoneyUnit;
use Modules\Config\Entities\ConfigPaymentType;
use Modules\Config\Entities\ConfigProductColor;
use Modules\Config\Entities\ConfigProductGroup;
use Modules\Config\Entities\ConfigProductKind;
use Modules\Config\Entities\ConfigProductQuality;
use Modules\Config\Entities\ConfigProductSize;
use Modules\Config\Entities\ConfigProductType;
use Modules\Config\Entities\ConfigProductUnit;

class ConfigHelper
{
    /**
     * @param null $resource
     * @return mixed
     */
    public static function getModel($resource = null) {
        if (!$resource) return abort(404);

        switch ($resource) {
            case config('config.product.kind'):
                return new ConfigProductKind();
            case config('config.product.type'):
                return new ConfigProductType();
            case config('config.product.group'):
                return new ConfigProductGroup();
            case config('config.product.color'):
                return new ConfigProductColor();
            case config('config.product.size'):
                return new ConfigProductSize();
            case config('config.product.unit'):
                return new ConfigProductUnit();
            case config('config.product.quality'):
                return new ConfigProductQuality();
            case config('config.finance.moneyUnit'):
                return new ConfigMoneyUnit();
            case config('config.finance.paymentType'):
                return new ConfigPaymentType();
            case config('config.finance.status'):
                return new ConfigFinanceStatus();
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
            case config('config.product.kind'):
                return ConfigProductKind::all($columns);
            case config('config.product.type'):
                return ConfigProductType::all();
            case config('config.product.group'):
                return ConfigProductGroup::all($columns);
            case config('config.product.color'):
                return ConfigProductColor::all($columns);
            case config('config.product.unit'):
                return ConfigProductUnit::all($columns);
            case config('config.product.quality'):
                return ConfigProductQuality::all($columns);
            case config('config.product.size'):
                return ConfigProductSize::all($columns);
            case config('config.finance.moneyUnit'):
                return ConfigMoneyUnit::all($columns);
            case config('config.finance.paymentType'):
                return ConfigPaymentType::all($columns);
            case config('config.finance.status'):
                return ConfigFinanceStatus::all($columns);
            default:
                return collect([]);
        }
    }
}