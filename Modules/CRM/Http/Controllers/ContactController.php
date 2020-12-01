<?php

namespace Modules\CRM\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Modules\CRM\Entities\CrmContact;
use Modules\CRM\Http\Requests\CrmContactRequest;

class ContactController extends BaseController
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $lists = CrmContact::all();
        return view('crm::contact.index', compact('lists'));
    }

    /**
     * Show the form for creating a new resource.
     * @param $customer
     * @return Renderable
     */
    public function create($customer)
    {
        return view('crm::contact.form', compact('customer'));
    }

    /**
     * @param CrmContactRequest $request
     * @param $customer
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(CrmContactRequest $request, $customer)
    {
        $data = $request->validated();
        $data['customer_id'] = $customer;
        if (CrmContact::create($data)) {
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
        $data = CrmContact::find($id);
        return view('crm::contact.form', compact('data'));
    }

    /**
     * @param CrmContactRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(CrmContactRequest $request, $id)
    {
        $data = $request->validated();
        $item = CrmContact::find($id);
        if ($item && $item->update($data)) {
            return $this->success('crm.customers.show', $item->customer_id);
        }
        return back()->withInput($data);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $item = CrmContact::find($id);
        if ($item && $item->delete()) {
            return $this->success('crm.customers.show', $item->customer_id);
        }
        return $this->error('crm.customers.index', $item->customer_id);
    }
}
