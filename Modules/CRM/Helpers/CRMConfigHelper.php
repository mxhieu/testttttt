<?php
/**
 * Created by PhpStorm.
 * User: hcenter
 * Date: 9/11/20
 * Time: 14:05
 */

namespace Modules\CRM\Helpers;

use Modules\CRM\Entities\Config\CrmConfigBusiness;
use Modules\CRM\Entities\Config\CrmConfigChannel;
use Modules\CRM\Entities\Config\CrmConfigCustomerGroup;
use Modules\CRM\Entities\Config\CrmConfigCustomerKind;
use Modules\CRM\Entities\Config\CrmConfigCustomerType;
use Modules\CRM\Entities\Config\CrmConfigDepartment;
use Modules\CRM\Entities\Config\CrmConfigMarket;
use Modules\CRM\Entities\Config\CrmConfigMarketingGroup;
use Modules\CRM\Entities\Config\CrmConfigMarketingKind;
use Modules\CRM\Entities\Config\CrmConfigMarketingType;
use Modules\CRM\Entities\Config\CrmConfigPosition;
use Modules\CRM\Entities\Config\CrmConfigRelation;
use Modules\CRM\Entities\Config\CrmConfigSaleKind;
use Modules\CRM\Entities\Config\CrmConfigActivityGroup;
use Modules\CRM\Entities\Config\CrmConfigActivityKind;
use Modules\CRM\Entities\Config\CrmConfigActivityType;
use Modules\CRM\Entities\Config\CrmConfigStatus;

class CRMConfigHelper
{
    /**
     * @param null $resource
     * @return mixed
     */
    public static function getModel($resource = null) {
        if (!$resource) return abort(404);

        switch ($resource) {
            case config('crm.config.customer.kind'):
                return new CrmConfigCustomerKind();
            case config('crm.config.customer.type'):
                return new CrmConfigCustomerType();
            case config('crm.config.customer.group'):
                return new CrmConfigCustomerGroup();
            case config('crm.config.sale.kind'):
                return new CrmConfigSaleKind();
            case config('crm.config.activity.kind'):
                return new CrmConfigActivityKind();
            case config('crm.config.activity.type'):
                return new CrmConfigActivityType();
            case config('crm.config.activity.group'):
                return new CrmConfigActivityGroup();
            case config('crm.config.marketing.kind'):
                return new CrmConfigMarketingKind();
            case config('crm.config.marketing.type'):
                return new CrmConfigMarketingType();
            case config('crm.config.marketing.group'):
                return new CrmConfigMarketingGroup();
            case config('crm.config.common.status'):
                return new CrmConfigStatus();
            case config('crm.config.common.relation'):
                return new CrmConfigRelation();
            case config('crm.config.common.business'):
                return new CrmConfigBusiness();
            case config('crm.config.common.department'):
                return new CrmConfigDepartment();
            case config('crm.config.common.position'):
                return new CrmConfigPosition();
            case config('crm.config.common.market'):
                return new CrmConfigMarket();
            case config('crm.config.common.channel'):
                return new CrmConfigChannel();
            default:
                return abort(404);
        }
    }

    /**
     * @param $resource
     * @return \Illuminate\Database\Eloquent\Collection|CrmConfigBusiness[]|CrmConfigDepartment[]|CrmConfigPosition[]|CrmConfigRelation[]
     */
    public static function getData($resource)
    {
        $columns = ['id', 'name'];
        switch ($resource) {
            case config('crm.config.customer.kind'):
                return CrmConfigCustomerKind::all($columns);
            case config('crm.config.customer.type'):
                return CrmConfigCustomerType::all();
            case config('crm.config.customer.group'):
                return CrmConfigCustomerGroup::all($columns);
            case config('crm.config.sale.kind'):
                return CrmConfigSaleKind::all($columns);
            case config('crm.config.activity.kind'):
                return CrmConfigActivityKind::all($columns);
            case config('crm.config.activity.type'):
                return CrmConfigActivityType::all($columns);
            case config('crm.config.activity.group'):
                return CrmConfigActivityGroup::all($columns);
            case config('crm.config.marketing.kind'):
                return CrmConfigMarketingKind::all($columns);
            case config('crm.config.marketing.type'):
                return CrmConfigMarketingType::all($columns);
            case config('crm.config.marketing.group'):
                return CrmConfigMarketingGroup::all($columns);
            case config('crm.config.common.status'):
                return CrmConfigStatus::all($columns);
            case config('crm.config.common.relation'):
                return CrmConfigRelation::all($columns);
            case config('crm.config.common.business'):
                return CrmConfigBusiness::all($columns);
            case config('crm.config.common.department'):
                return CrmConfigDepartment::all($columns);
            case config('crm.config.common.position'):
                return CrmConfigPosition::all($columns);
            case config('crm.config.common.channel'):
                return CrmConfigChannel::all($columns);
            case config('crm.config.common.market'):
                return CrmConfigMarket::all($columns);
            default:
                return collect([]);
        }
    }
}