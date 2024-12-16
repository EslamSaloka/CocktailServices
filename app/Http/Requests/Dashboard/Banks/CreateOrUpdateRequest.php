<?php

namespace App\Http\Requests\Dashboard\Banks;

use Illuminate\Foundation\Http\FormRequest;

class CreateOrUpdateRequest extends FormRequest
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
           'bank_name'                  => 'required|string|max:150',
           'account_name'               => 'required|string|max:150',
           'account_number'             => 'required|string|max:150',
           'iban'                       => 'required|string|max:150',
        ];
        return $rules;
    }
}
