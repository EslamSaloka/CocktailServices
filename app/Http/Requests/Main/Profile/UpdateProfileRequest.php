<?php

namespace App\Http\Requests\Main\Profile;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

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
    public function rules() {
        return [
            'username'          => 'required',
            'phone'             => 'required|numeric|digits:10|regex:/(05)[0-9]{8}/|not_regex:/[a-z]/',
            'area'              => 'required',
            'id_number'         => 'required',
            'employer_id'       => 'required|numeric',
            'employer_name'     => 'required',
            'employer_years'    => 'required|numeric',
            'salary'            => 'required|numeric',
        ];
    }
}
