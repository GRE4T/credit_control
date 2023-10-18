<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'email' => 'required|string|email:rfc,dns|unique:users',
            'username' => 'required|alpha_num|unique:users|min:6|max:35',
            'password' => 'required|string|min:8',
            'is_admin' => 'nullable|boolean'
        ];
    }
}
