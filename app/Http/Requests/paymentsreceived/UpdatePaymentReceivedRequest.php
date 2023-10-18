<?php

namespace App\Http\Requests\paymentsreceived;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePaymentReceivedRequest extends FormRequest
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
            'receipt_number' => 'required|numeric|alpha_num|digits_between:0,20|unique:payments_received,receipt_number,'. $this->paymentsreceived->id . ',id',
            'value' => 'nullable|numeric|min:0',
        ];
    }
}
