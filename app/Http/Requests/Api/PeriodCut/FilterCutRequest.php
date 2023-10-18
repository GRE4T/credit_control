<?php

namespace App\Http\Requests\Api\PeriodCut;

use Illuminate\Foundation\Http\FormRequest;

class FilterCutRequest extends FormRequest
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
            'filters.percentage' => 'nullable|numeric|min:0|max:100'
        ];
    }
}
