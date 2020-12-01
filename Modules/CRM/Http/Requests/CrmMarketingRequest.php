<?php

namespace Modules\CRM\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CrmMarketingRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'files' => 'nullable',
            'name' => 'required',
            'type_id' => 'required',
            'kind_id' => 'required',
            'group_id' => 'required',
            'in_charge_id' => 'required',
            'user_group_id' => 'required',
            'remark' => 'required',
            'start_at' => 'required|date',
            'end_at' => 'required|date',
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
