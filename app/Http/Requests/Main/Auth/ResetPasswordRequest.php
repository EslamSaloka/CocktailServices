<?php

namespace App\Http\Requests\Main\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ResetPasswordRequest extends FormRequest
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
    public function rules() {
        $rules = [
            'otp'       => 'required|min:4',
            'password'  => 'required|min:8',
        ];
        return $rules;
    }
}
