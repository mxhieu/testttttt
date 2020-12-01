<?php

namespace Modules\CRM\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Modules\Config\Helpers\ConfigHelper;
use Modules\CRM\Entities\CrmProduct;
use Modules\CRM\Http\Requests\CrmProductRequest;
use Modules\CRM\Services\ProductService;

class ProductController extends BaseController
{
    /**
     * Display a listing of the resource.
     * @param Request $request
     * @param ProductService $service
     * @return Renderable
     */
    public function index(Request $request, ProductService $service)
    {
        $kinds = ConfigHelper::getData(config('config.product.kind'));
        $types = ConfigHelper::getData(config('config.product.type'));
        $groups = ConfigHelper::getData(config('config.product.group'));
        $colors = ConfigHelper::getData(config('config.product.color'));

        $filters = $request->only('name', 'color_id', 'kind_id', 'type_id', 'group_id');
        $lists = [];
        if ( !empty($filters) ) {
            $lists = $service->lists($filters);
        }
        return view('crm::product.index', compact('lists', 'filters', 'kinds', 'types', 'groups', 'colors'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $kinds = ConfigHelper::getData(config('config.product.kind'));
        $types = ConfigHelper::getData(config('config.product.type'));
        $groups = ConfigHelper::getData(config('config.product.group'));
        $colors = ConfigHelper::getData(config('config.product.color'));
        $qualities = ConfigHelper::getData(config('config.product.quality'));
        $moneyUnits = ConfigHelper::getData(config('config.finance.moneyUnit'));
        $units = ConfigHelper::getData(config('config.product.unit'));
        $sizes = ConfigHelper::getData(config('config.product.size'));

        return view('crm::product.form', compact('kinds', 'types', 'groups', 'colors', 'qualities', 'moneyUnits', 'units', 'sizes'));
    }

    /**
     * @param CrmProductRequest $request
     * @param ProductService $service
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(CrmProductRequest $request, ProductService $service)
    {
        if ($service->store($request)) {
            return $this->success('crm.products.index');
        }
        return back()->withInput($request->validated());
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('crm::product.show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $kinds = ConfigHelper::getData(config('config.product.kind'));
        $types = ConfigHelper::getData(config('config.product.type'));
        $groups = ConfigHelper::getData(config('config.product.group'));
        $colors = ConfigHelper::getData(config('config.product.color'));
        $qualities = ConfigHelper::getData(config('config.product.quality'));
        $moneyUnits = ConfigHelper::getData(config('config.finance.moneyUnit'));
        $units = ConfigHelper::getData(config('config.product.unit'));
        $sizes = ConfigHelper::getData(config('config.product.size'));
        $data = CrmProduct::find($id);
        return view('crm::product.form', compact('data','kinds', 'types', 'groups', 'colors', 'qualities', 'moneyUnits', 'units', 'sizes'));
    }

    /**
     * @param CrmProductRequest $request
     * @param $id
     * @param ProductService $service
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(CrmProductRequest $request, $id, ProductService $service)
    {
        if ($service->update($request, $id)) {
            return $this->success('crm.products.index');
        }
        return back()->withInput($request->validated());
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $item = CrmProduct::find($id);
        if ($item && $item->delete()) {
            return $this->success('crm.products.index');
        }
        return $this->error('crm.products.index');
    }
}
