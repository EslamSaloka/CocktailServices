<?php

namespace App\Http\Requests\Dashboard\User;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
            'username'  => 'required|string|max:30|unique:users,username',
            'phone'             => 'required|unique:users,phone|numeric|digits:10|regex:/(05)[0-9]{8}/|not_regex:/[a-z]/',
            'password' => ['required', 'max:20'],
            'role' => 'required|exists:roles,name',
            'avatar' => 'nullable|image|max:10240',
            'suspend' => 'nullable|boolean'
        ];
    }
}
