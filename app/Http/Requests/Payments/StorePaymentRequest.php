<?php

namespace App\Http\Requests\Payments;

use Illuminate\Foundation\Http\FormRequest;

class StorePaymentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'agreement_id' => 'required|exists:agreements,id',
            'headquarter_id' => 'required|exists:headquarters,id',
            'credit_number' => 'nullable|alpha_num|max:50',
            'credit_pos_number' => 'nullable|alpha_num|max:50',
            'receipt_number' => 'required|numeric|digits_between:0,20|unique:payments,receipt_number',
            'value' => 'required|numeric|min:0',
            'date' => 'required|date'
        ];
    }

}
