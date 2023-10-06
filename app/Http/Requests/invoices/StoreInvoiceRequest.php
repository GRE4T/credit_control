<?php

namespace App\Http\Requests\invoices;

use Illuminate\Foundation\Http\FormRequest;

class StoreInvoiceRequest extends FormRequest
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
            'invoice_pos_number' => 'required|numeric|alpha_num',
            'invoice_agreement' => 'required|numeric|alpha_num',
            'value' => 'required|numeric|min:0',
            'detail' => 'nullable|string'
        ];
    }
}