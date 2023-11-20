<?php

namespace App\Http\Requests\CutRegisters;

use Illuminate\Foundation\Http\FormRequest;

class StoreCutRegisterRequest extends FormRequest
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
            'value'=>'required|numeric',
            'date'=>'required|date|unique:cut_registers,date',
            'detail'=>'nullable|string',
        ];
    }
}
