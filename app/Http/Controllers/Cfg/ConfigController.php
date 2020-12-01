<?php
/**
 * Created by PhpStorm.
 * User: hcenter
 * Date: 9/14/20
 * Time: 09:48
 */

namespace App\Http\Controllers\Cfg;


use App\Helpers\ConfigHelper;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class ConfigController extends BaseController
{
    /**
     * @param string $resource
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($resource='typeProduct')
    {
        $model = ConfigHelper::getModel($resource);
        $lists = $model->all();
        return view('crm::config.index', compact('resource', 'lists'));
    }

    /**
     * @param Request $request
     * @param string $resource
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, $resource='typeProduct')
    {
        $model = ConfigHelper::getModel($resource);
        $model->create([
            'name' => $request->name
        ]);
        return back();
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @param string $resource
     * @return void
     */
    public function update(Request $request, $id, $resource='typeProduct')
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @param string $resource
     * @return void
     */
    public function destroy($id, $resource='typeProduct')
    {
        //
    }
}