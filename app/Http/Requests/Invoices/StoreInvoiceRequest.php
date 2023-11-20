<?php

namespace App\Http\Requests\Invoices;

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
            'invoice_pos_number' => 'nullable|alpha_num|max:50|unique:invoices,invoice_pos_number',
            'invoice_agreement' => 'required|alpha_num|max:50|unique:invoices,invoice_agreement',
            'value' => 'required|numeric|min:0',
            'detail' => 'nullable|string',
            'date' => 'required|date',
            'expiration_date' => 'required|date|after_or_equal:'. date('Y-m-d'),
        ];
    }
}
