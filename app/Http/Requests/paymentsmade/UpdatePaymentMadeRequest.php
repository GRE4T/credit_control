<?php

namespace App\Http\Requests\paymentsmade;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePaymentMadeRequest extends FormRequest
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
            'type_payment' => 'nullable|string|max:255',
            'receipt_number' => 'required|numeric|digits_between:0,20|unique:payments_made,receipt_number,' . $this->paymentsmade->id . ',id',
            'detail' => 'nullable|string',
            'value' => 'nullable|numeric|min:0'
        ];
    }
}
