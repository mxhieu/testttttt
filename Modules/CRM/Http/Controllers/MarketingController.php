<?php

namespace Modules\CRM\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Modules\CRM\Entities\CrmMarketing;
use Modules\CRM\Helpers\CRMConfigHelper;
use Modules\CRM\Http\Requests\CrmMarketingRequest;
use Modules\CRM\Services\MarketingService;
use Modules\Config\Entities\Employee;
use Modules\Config\Entities\EmployeeGroup;

class MarketingController extends BaseController
{
    /**
     * Display a listing of the resource.
     * @param Request $request
     * @param MarketingService $service
     * @return Renderable
     */
    public function index(Request $request, MarketingService $service)
    {
        $employeesGroup = EmployeeGroup::all(['id', 'name']);
        $groups = CRMConfigHelper::getData(config('crm.config.marketing.group'));
        $types = CRMConfigHelper::getData(config('crm.config.marketing.type'));
        $kinds = CRMConfigHelper::getData(config('crm.config.marketing.kind'));
        $details = optional($employeesGroup->first())->details;
        $employeeIds = $details ? $details->pluck('employee_id')->toArray() : [];
        $employee = Employee::whereIn('id', $employeeIds)->get();

        $filters = $request->only('name', 'kind_id', 'user_group_id', 'in_charge_id', 'type_id', 'group_id');
        $lists = [];
        if ( !empty($filters) ) {
            $lists = $service->lists($filters);
        }
        return view('crm::marketing.index', compact('lists', 'employeesGroup', 'groups', 'types', 'kinds', 'employee', 'filters'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $employeesGroup = EmployeeGroup::all(['id', 'name']);
        $groups = CRMConfigHelper::getData(config('crm.config.marketing.group'));
        $types = CRMConfigHelper::getData(config('crm.config.marketing.type'));
        $kinds = CRMConfigHelper::getData(config('crm.config.marketing.kind'));
        $details = optional($employeesGroup->first())->details;
        $employeeIds = $details ? $details->pluck('employee_id')->toArray() : [];
        $employee = Employee::whereIn('id', $employeeIds)->get();
        return view('crm::marketing.form', compact('groups', 'types', 'kinds', 'employeesGroup', 'employee'));
    }

    /**
     * @param CrmMarketingRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(CrmMarketingRequest $request)
    {
        $data = $request->validated();
        if (CrmMarketing::create($data)) {
            return $this->success('crm.marketing.index');
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
        $data = CrmMarketing::findOrFail($id);
        $employeesGroup = EmployeeGroup::all(['id', 'name']);
        $groups = CRMConfigHelper::getData(config('crm.config.marketing.group'));
        $types = CRMConfigHelper::getData(config('crm.config.marketing.type'));
        $kinds = CRMConfigHelper::getData(config('crm.config.marketing.kind'));
        $details = optional(EmployeeGroup::find($data->user_group_id))->details;
        $employeeIds = $details ? $details->pluck('employee_id')->toArray() : [];
        $employee = Employee::whereIn('id', $employeeIds)->get();

        return view('crm::marketing.form', compact('groups', 'types', 'kinds', 'employeesGroup', 'employee', 'data'));
    }

    /**
     * @param CrmMarketingRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(CrmMarketingRequest $request, $id)
    {
        $data = $request->validated();
        $item = CrmMarketing::findOrFail($id);
        if ($item && $item->update($data)) {
            return $this->success('crm.marketing.index');
        }
        return back()->withInput($data);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $item = CrmMarketing::find($id);
        if ($item && $item->delete()) {
            return $this->success('crm.marketing.index');
        }
        return $this->error('crm.marketing.index');
    }
}
