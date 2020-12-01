<?php
/**
 * Created by PhpStorm.
 * User: hcenter
 * Date: 9/17/20
 * Time: 22:43
 */

namespace Modules\CRM\Services;


use Illuminate\Support\Arr;
use Modules\CRM\Entities\CrmProduct;
use Modules\CRM\Entities\CrmProductNature;
use Modules\CRM\Entities\CrmProductProperty;
use Modules\CRM\Entities\CrmProductQuality;
use Modules\CRM\Http\Requests\CrmProductRequest;

class ProductService
{
    /**
     * @param array $filters
     * @return mixed
     */
    public function lists(array $filters)
    {
        $service = new SupportQuery();

        $model = CrmProduct::with(['color', 'kind', 'group', 'type']);
        $model = $service->applyWhere($model, Arr::get($filters, 'color_id'), 'color_id');
        $model = $service->applyWhere($model, Arr::get($filters, 'kind_id'), 'kind_id');
        $model = $service->applyWhere($model, Arr::get($filters, 'type_id'), 'type_id');
        $model = $service->applyWhere($model, Arr::get($filters, 'group_id'), 'group_id');
        $model = $service->applyLike($model, Arr::get($filters, 'name'), ['name']);

        return $model->get();
    }
    /**
     * @param CrmProductRequest $request
     * @return bool
     */
    public function store(CrmProductRequest $request)
    {
        try{
            $quantity = $request->quantity;
            $data = $request->only('images', 'files', 'name', 'name', 'type_id', 'kind_id', 'group_id', 'color_id', 'description', 'totalQuantity');
            $data['images'] = explode(',', $data['images']);
            $data['files'] = $data['files'] ? explode(',', $data['files']) : [];
            $product = CrmProduct::create($data);

            $nature = new CrmProductNature($request->nature);
            $product->nature()->save($nature);

            $propertyData = [
                array_merge($request->money, ['type' => 'money', 'product_id' => $product->id]),
                array_merge($quantity, ['type' => 'quantity', 'product_id' => $product->id]),
            ];
            CrmProductProperty::insert($propertyData);

            $qualityIds = $request->quality_ids;
            $qualityData = [];
            foreach ($qualityIds as $id){
                $qualityData[] = [
                    'product_id' => $product->id,
                    'quality_id' => $id
                ];
            }
            CrmProductQuality::insert($qualityData);
            return true;
        }catch (\Exception $exception) {
            logger('ProductService store errors' . $exception->getMessage());
        }
        return false;
    }

    /**
     * @param CrmProductRequest $request
     * @param $id
     * @return bool
     */
    public function update(CrmProductRequest $request, $id)
    {
        try{
            $quantity = $request->quantity;
            $data = $request->only('images', 'files', 'name', 'name', 'type_id', 'kind_id', 'group_id', 'color_id', 'description', 'totalQuantity');
            $data['images'] = explode(',', $data['images']);
            $data['files'] = $data['files'] ? explode(',', $data['files']) : [];
            $product = CrmProduct::find($id);
            $product->update($data);

            $nature = new CrmProductNature($request->nature);
            $product->nature()->save($nature);

            $propertyData = [
                array_merge($request->money, ['type' => 'money', 'product_id' => $product->id]),
                array_merge($quantity, ['type' => 'quantity', 'product_id' => $product->id]),
            ];
            CrmProductProperty::where(['product_id' => $product->id])->delete();
            CrmProductProperty::insert($propertyData);

            $qualityIds = $request->quality_ids;
            $qualityData = [];
            foreach ($qualityIds as $id){
                $qualityData[] = [
                    'product_id' => $product->id,
                    'quality_id' => $id
                ];
            }
            CrmProductQuality::where(['product_id' => $product->id])->delete();
            CrmProductQuality::insert($qualityData);
            return true;
        }catch (\Exception $exception) {
            logger('ProductService update errors' . $exception->getMessage());
        }
        return false;
    }
}