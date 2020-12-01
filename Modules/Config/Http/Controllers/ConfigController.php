<?php

namespace Modules\Config\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Modules\Config\Helpers\ConfigHelper;

class ConfigController extends BaseController
{
    /**
     * Display a listing of the resource.
     * @param string $resource
     * @return Renderable
     */
    public function index($resource='typeProduct')
    {
        $model = ConfigHelper::getModel($resource);
        $isColor = $model->isColor || false;
        $lists = $model->all();
        return view('config::config.index', compact('resource', 'lists', 'isColor'));
    }

    /**
     * @param Request $request
     * @param string $resource
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, $resource='typeProduct')
    {
        $model = ConfigHelper::getModel($resource);
        $isColor = $model->isColor || false;
        $data = [
            'name' => $request->name
        ];
        if ($isColor) {
            $data = array_merge($data, ['color' => $request->color]);
        }
        $model->create($data);
        return $this->success('config.index', $resource);
    }

    /**
     * Display a listing of the resource.
     * @param string $resource
     * @param $id
     * @return Renderable
     */
    public function edit($resource, $id)
    {
        $model = ConfigHelper::getModel($resource);
        $isColor = $model->isColor || false;
        $lists = $model->all();
        $data = $model->find($id);
        return view('config::config.index', compact('resource', 'lists', 'data', 'isColor'));
    }

    /**
     * @param Request $request
     * @param $id
     * @param string $resource
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $resource, $id)
    {
        $model = ConfigHelper::getModel($resource);
        $item = $model->find($id);
        $isColor = $model->isColor || false;
        $data = [
            'name' => $request->name
        ];
        if ($isColor) {
            $data = array_merge($data, ['color' => $request->color]);
        }
        if ($item->update($data)) {
            return $this->success('config.index', $resource);
        }
        return $this->error('config.index', $resource);
    }

    /**
     * @param $resource
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($resource, $id)
    {
        $model = ConfigHelper::getModel($resource);
        $item = $model->find($id);
        if ($item && $item->delete()) {
            return $this->success('config.index', $resource);
        }
        return $this->error('config.index', $resource);
    }
}
