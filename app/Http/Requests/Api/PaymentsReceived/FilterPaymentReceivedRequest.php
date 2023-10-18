<?php

namespace App\Http\Requests\Api\PaymentsReceived;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class FilterPaymentReceivedRequest extends FormRequest
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
            'filters' => 'nullable|array',
            'filters.agreement_id' => 'nullable|exists:agreements,id',
            'filters.headquarter_id' => 'nullable|exists:headquarters,id',
            'filters.start_date' => 'nullable|date',
            'filters.end_date' => 'nullable|date',
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
