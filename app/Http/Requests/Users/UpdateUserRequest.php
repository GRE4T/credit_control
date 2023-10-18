<?php

namespace App\Http\Requests\Users;

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
        $user = $this->routeIs('users.update') ? $this->user : $this->user();
        return [
            'name' => 'required|string|max:100',
            'email' => 'required|string|email:rfc,dns|unique:users,email,'.$user->id.',id',
            'username' => 'required|alpha_num|min:6|max:35|unique:users,username,'.$user->id.',id',
            'password' => 'nullable|string|min:8',
            'is_admin' => 'nullable|boolean'
        ];
    }
}
