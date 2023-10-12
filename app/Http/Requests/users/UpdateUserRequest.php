<?php

namespace App\Http\Requests\users;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'name' => 'required|string|max:100',
            'email' => 'required|string|email:rfc,dns|unique:users,email,'.$this->user->id.',id',
            'username' => 'required|alpha_num|min:6|max:35|unique:users,username,'.$this->user->id.',id',
            'password' => 'nullable|string|min:8'
        ];
    }
}
