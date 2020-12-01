<?php

namespace Modules\CRM\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Modules\Config\Entities\Status;
use Modules\CRM\Entities\CrmActivity;
use Modules\CRM\Entities\CrmCustomer;
use Modules\CRM\Helpers\CRMConfigHelper;
use Modules\CRM\Http\Requests\CrmActivityRequest;
use Modules\CRM\Services\ActivityService;

class ActivityController extends BaseController
{
    /**
     * Display a listing of the resource.
     * @param Request $request
     * @param ActivityService $service
     * @return Renderable
     */
    public function index(Request $request, ActivityService $service)
    {
        $columns = ['id', 'name'];
        $customers = CrmCustomer::all($columns);
        $groups = CRMConfigHelper::getData(config('crm.config.sale.group'));
        $types = CRMConfigHelper::getData(config('crm.config.sale.type'));
        $kinds = CRMConfigHelper::getData(config('crm.config.sale.kind'));
        $statuses = Status::all($columns);

        $filters = $request->only('type_id', 'customer_id', 'status_id', 'name', 'group_id', 'kind_id');
        $lists = [];
        if ( !empty($filters) ) {
            $lists = $service->lists($filters);
        }

        return view('crm::activities.index', compact('lists', 'customers', 'groups', 'types', 'kinds', 'statuses', 'filters'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function grantt(Request $request)
    {
        $columns = ['id', 'name'];
        $customers = CrmCustomer::all($columns);
        $groups = CRMConfigHelper::getData(config('crm.config.sale.group'));
        $types = CRMConfigHelper::getData(config('crm.config.sale.type'));
        $kinds = CRMConfigHelper::getData(config('crm.config.sale.kind'));
        $statuses = Status::all($columns);

        $filters = $request->only('type_id', 'customer_id', 'status_id', 'name', 'group_id', 'kind_id');
        return view('crm::activities.grantt-chart', compact('customers', 'groups', 'types', 'kinds', 'statuses', 'filters'));
    }

    /**
     * @param Request $request
     * @param ActivityService $service
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function granttData(Request $request, ActivityService $service)
    {
        $filters = $request->only('type_id', 'customer_id', 'status_id', 'name', 'group_id', 'kind_id');
        $lists = [];
        if ( !empty($filters) ) {
            $lists = $service->lists($filters);
        }
        $result = [];

        foreach ($lists as $key => $row) {
            $result[$key]['y'] = $key;
            $result[$key]['name'] = $row->name;
            $result[$key]['customer'] = optional($row->customer)->name;
            $result[$key]['start'] = strtotime($row->start_at) * 1000;
            $result[$key]['end'] = strtotime($row->end_at) * 1000;
            $result[$key]['completed'] = $row->complete / 100;
        }
        return response($result);
    }

    /**
     * Show the form for creating a new resource.
     * @param $customer
     * @return Renderable
     */
    public function create($customer)
    {
        $columns = ['id', 'name'];
        $groups = CRMConfigHelper::getData(config('crm.config.sale.group'));
        $types = CRMConfigHelper::getData(config('crm.config.sale.type'));
        $kinds = CRMConfigHelper::getData(config('crm.config.sale.kind'));
        $statues = Status::all($columns);
        return view('crm::activities.form', compact('groups', 'types', 'kinds', 'statues', 'customer'));
    }

    /**
     * @param CrmActivityRequest $request
     * @param $customer
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(CrmActivityRequest $request, $customer)
    {
        $data = $request->validated();
        $data['customer_id'] = $customer;
        if (CrmActivity::create($data)) {
            return $this->success('crm.customers.show', $customer);
        }
        return back()->withInput($data);
    }
    
    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $columns = ['id', 'name'];
        $data = CrmActivity::findOrFail($id);
        $groups = CRMConfigHelper::getData(config('crm.config.sale.group'));
        $types = CRMConfigHelper::getData(config('crm.config.sale.type'));
        $kinds = CRMConfigHelper::getData(config('crm.config.sale.kind'));
        $statues = Status::all($columns);

        return view('crm::activities.form', compact('groups', 'types', 'kinds', 'statues', 'data'));
    }

    /**
     * @param CrmActivityRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(CrmActivityRequest $request, $id)
    {
        $data = $request->validated();
        $item = CrmActivity::findOrFail($id);
        if ($item && $item->update($data)) {
            return $this->success('crm.activities.index');
        }
        return back()->withInput($data);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $item = CrmActivity::find($id);
        if ($item && $item->delete()) {
            return $this->success('crm.activities.index');
        }
        return $this->error('crm.activities.index');
    }
}
