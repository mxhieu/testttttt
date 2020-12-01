<?php

namespace Modules\CRM\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Modules\CRM\Helpers\CRMConfigHelper;

class ConfigController extends BaseController
{
    /**
     * Display a listing of the resource.
     * @param string $resource
     * @return Renderable
     */
    public function index($resource='typeCustomer')
    {
        $model = CRMConfigHelper::getModel($resource);
        $isColor = $model->isColor || false;
        $lists = $model->all();
        return view('crm::config.index', compact('resource', 'lists', 'isColor'));
    }

    /**
     * @param Request $request
     * @param string $resource
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, $resource='typeCustomer')
    {
        $model = CRMConfigHelper::getModel($resource);
        $isColor = $model->isColor || false;
        $data = [
            'name' => $request->name
        ];
        if ($isColor) {
            $data = array_merge($data, ['color' => $request->color]);
        }
        $model->create($data);
        return back();
    }

    /**
     * Display a listing of the resource.
     * @param string $resource
     * @param $id
     * @return Renderable
     */
    public function edit($resource, $id)
    {
        $model = CRMConfigHelper::getModel($resource);
        $isColor = $model->isColor || false;
        $lists = $model->all();
        $data = $model->find($id);
        return view('crm::config.index', compact('resource', 'lists', 'data', 'isColor'));
    }

    /**
     * @param Request $request
     * @param $resource
     * @param $id
     * @return mixed
     */
    public function update(Request $request, $resource, $id)
    {
        $model = CRMConfigHelper::getModel($resource);
        $item = $model->find($id);
        $isColor = $model->isColor || false;
        $data = [
            'name' => $request->name
        ];
        if ($isColor) {
            $data = array_merge($data, ['color' => $request->color]);
        }
        if ($item->update($data)) {
            return $this->success('crm.config.index', $resource);
        }
        return $this->error('crm.config.index', $resource);
    }

    /**
     * @param $resource
     * @param $id
     * @return mixed
     */
    public function destroy($resource, $id)
    {
        $model = CRMConfigHelper::getModel($resource);
        $item = $model->find($id);
        if ($item && $item->delete()) {
            return $this->success('crm.config.index', $resource);
        }
        return $this->error('crm.config.index', $resource);
    }
}
