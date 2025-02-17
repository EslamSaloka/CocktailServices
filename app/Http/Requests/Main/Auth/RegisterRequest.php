<?php

namespace App\Http\Requests\Main\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class RegisterRequest extends FormRequest
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
            'username'          => 'required',
            'phone'             => 'required|unique:users,phone|numeric|digits:10|regex:/(05)[0-9]{8}/|not_regex:/[a-z]/',
            'area'              => 'required',
            'id_number'         => 'required',
            'employer_id'       => 'required|numeric',
            'employer_name'     => 'required',
            'employer_years'    => 'required|numeric',
            'salary'            => 'required|numeric',
            'password'          => 'required|min:8',
        ];

        return $rules;
    }
}
