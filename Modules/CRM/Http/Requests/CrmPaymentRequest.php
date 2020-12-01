<?php

namespace Modules\CRM\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CrmPaymentRequest extends FormRequest
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
            'payment_type_id' => 'required',
            'money' => 'required',
            'note' => 'nullable',
            'date' => 'nullable|date',
            'customer_id' => 'required',
            'description' => 'nullable'
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
