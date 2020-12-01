<?php

namespace Modules\CRM\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CrmProductRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'images' => 'required',
            'files' => 'nullable',
            'name' => 'required',
            //'code' => 'required|unique:crm_products,code',
            'type_id' => 'required',
            'kind_id' => 'required',
            'group_id' => 'required',
            'quality_ids' => 'required|array',
            'color_id' => 'required',
            'money' => 'required|array',
            'quantity' => 'required|array',
            'description' => 'required',
            'nature' => 'required|array',
            'totalQuantity' => 'required|numeric',
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
