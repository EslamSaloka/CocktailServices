<?php

namespace App\Http\Requests\Dashboard\Profile;

use App\Rules\ValidateUserPhone;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateProfileRequest extends FormRequest
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
            'username'     => ['nullable', 'max:30'],
            'phone'             => [
                'required',
                'unique:users,phone,'.Auth::user()->id.',id',
                'numeric',
                'digits:10',
                'regex:/(05)[0-9]{8}/',
            ],
            'avatar'        => 'nullable|image|max:10240',
            'avatar_deleted'=> 'nullable',
        ];
    }
}
