<?php

namespace App\Http\Requests\invoices;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInvoiceRequest extends FormRequest
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
            'invoice_pos_number' => 'required|alpha_num|max:50|unique:invoices,invoice_pos_number,'.$this->invoice->id.',id',
            'invoice_agreement' => 'required|alpha_num|max:50|unique:invoices,invoice_agreement,'.$this->invoice->id.',id',
            'detail' => 'nullable|string'
        ];
    }
}
