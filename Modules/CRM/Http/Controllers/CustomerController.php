<?php

namespace Modules\CRM\Http\Controllers;

use App\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Modules\CRM\Entities\CrmContact;
use Modules\CRM\Entities\CrmCustomer;
use Modules\CRM\Http\Requests\CrmCustomerRequest;
use Modules\CRM\Helpers\CRMConfigHelper;
use Modules\CRM\Services\CustomerService;

class CustomerController extends BaseController
{
    /**
     * Display a listing of the resource.
     * @param Request $request
     * @param CustomerService $service
     * @return Renderable
     */
    public function index(Request $request, CustomerService $service)
    {
        $channels = CRMConfigHelper::getData(config('crm.config.common.channel'));
        $groups = CRMConfigHelper::getData(config('crm.config.customer.group'));
        $types = CRMConfigHelper::getData(config('crm.config.customer.type'));
        $kinds = CRMConfigHelper::getData(config('crm.config.customer.kind'));
        $markets = CRMConfigHelper::getData(config('crm.config.common.market'));
        $relations = CRMConfigHelper::getData(config('crm.config.common.relation'));

        $filters = $request->only('name', 'phone', 'market_id', 'kind_id', 'channel_id', 'relation_id', 'type_id', 'group_id');
        $lists = $service->lists($filters);
        return view('crm::customer.index', compact('lists', 'channels', 'groups', 'types', 'kinds', 'markets', 'relations', 'filters'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $channels = CRMConfigHelper::getData(config('crm.config.common.channel'));
        $groups = CRMConfigHelper::getData(config('crm.config.customer.group'));
        $types = CRMConfigHelper::getData(config('crm.config.customer.type'));
        $kinds = CRMConfigHelper::getData(config('crm.config.customer.kind'));
        $markets = CRMConfigHelper::getData(config('crm.config.common.market'));
        $relations = CRMConfigHelper::getData(config('crm.config.common.relation'));
        $employees = User::all(['id', 'name']);

        return view('crm::customer.form', compact('channels', 'groups', 'types', 'kinds', 'markets', 'relations', 'employees'));
    }

    /**
     * @param CrmCustomerRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(CrmCustomerRequest $request)
    {
        $data = $request->validated();
        if (CrmCustomer::create($data)) {
            return $this->success('crm.customers.index');
        }
        return back()->withInput($data);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $data = CrmCustomer::find($id);
        $contacts = CrmContact::where(['customer_id' => $id])->get();
        return view('crm::customer.show', compact('data', 'contacts'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $channels = CRMConfigHelper::getData(config('crm.config.common.channel'));
        $groups = CRMConfigHelper::getData(config('crm.config.customer.group'));
        $types = CRMConfigHelper::getData(config('crm.config.customer.type'));
        $kinds = CRMConfigHelper::getData(config('crm.config.customer.kind'));
        $markets = CRMConfigHelper::getData(config('crm.config.common.market'));
        $relations = CRMConfigHelper::getData(config('crm.config.common.relation'));
        $employees = User::all(['id', 'name']);
        $data = CrmCustomer::find($id);

        return view('crm::customer.form', compact('data', 'channels', 'groups', 'types', 'kinds', 'markets', 'relations', 'employees'));
    }

    /**
     * @param CrmCustomerRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(CrmCustomerRequest $request, $id)
    {
        $data = $request->validated();
        $item = CrmCustomer::find($id);
        if ($item && $item->update($data)) {
            return $this->success('crm.customers.index');
        }
        return back()->withInput($data);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $item = CrmCustomer::find($id);
        if ($item && $item->delete()) {
            return $this->success('crm.customers.index');
        }
        return $this->error('crm.customers.index');
    }
}
