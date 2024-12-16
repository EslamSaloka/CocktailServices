<?php

namespace App\Http\Requests\Dashboard\User;

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
        $id = $this->user->id;
        return [
            'username'  => 'required|string|max:30|unique:users,username,'.$id.',id',
            'phone'             => [
                'required',
                'unique:users,phone,'.$id.',id',
                'numeric',
                'digits:10',
                'regex:/(05)[0-9]{8}/',
            ],
            'password' => ['nullable', 'max:20'],
            'role' =>   'required|exists:roles,name',
            'avatar' => 'nullable|image|max:10240',
            'suspend' => 'nullable|boolean'
        ];
    }
}
