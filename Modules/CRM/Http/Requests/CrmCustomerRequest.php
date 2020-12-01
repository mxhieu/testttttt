<?php

namespace Modules\CRM\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CrmCustomerRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'tax_id' => 'required',
            'address' => 'required',
            'market_id' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'website' => 'required',
            'find_at' => 'required',
            'kind_id' => 'required',
            'type_id' => 'required',
            'group_id' => 'required',
            'channel_id' => 'required',
            'relation_id' => 'required',
            'employee_id' => 'required',
            'description' => 'nullable|string|max:255',
            'logo' => 'nullable|string|max:255',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
