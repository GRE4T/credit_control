<?php

namespace App\Http\Requests\payments;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePaymentRequest extends FormRequest
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
            'credit_number' => 'required|alpha_num|max:50',
            'credit_pos_number' => 'required|alpha_num|max:50',
            'receipt_number' => 'required|numeric|alpha_num|digits_between:0,20|unique:payments,receipt_number,'.$this->payment->id.',id',
        ];
    }
}
