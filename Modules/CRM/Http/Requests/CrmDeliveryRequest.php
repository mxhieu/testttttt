<?php

namespace Modules\CRM\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CrmDeliveryRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'sale_id' => 'required',
            'status_id' => 'required',
            'address' => 'required',
            'note' => 'nullable',
            'date' => 'nullable|date',
            'customer_id' => 'required',
            'products' => 'required|array'
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
