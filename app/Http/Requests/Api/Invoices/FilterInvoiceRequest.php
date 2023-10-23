<?php

namespace App\Http\Requests\Api\Invoices;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class FilterInvoiceRequest extends FormRequest
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
        $paymentStatus = implode(',', array_keys(config('agreements.payment_status')));
        return [
            'filters' => 'nullable|array',
            'filters.agreement_id' => 'nullable|exists:agreements,id',
            'filters.headquarter_id' => 'nullable|exists:headquarters,id',
            'filters.start_date' => 'nullable|date',
            'filters.end_date' => 'nullable|date',
            'filters.invoice_state_id' => 'nullable|exists:invoice_states,id',
            'filters.payment_status' => 'nullable|string|in:' . $paymentStatus,
            'filters.expiration_date_end' => 'nullable|date',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status' => 'error',
            'code' => 422,
            'errors' => $validator->errors(),
            'message' => 'Incorrect data validation'
        ], 422));
    }
}
