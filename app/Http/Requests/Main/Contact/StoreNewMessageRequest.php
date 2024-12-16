<?php

namespace App\Http\Requests\Main\Contact;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class StoreNewMessageRequest extends FormRequest
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
           'name'       => 'required|string|max:150',
           'phone'      => 'required|numeric|digits:10|regex:/(05)[0-9]{8}/|not_regex:/[a-z]/',
           'message'    => 'required|string',
        ];

        return $rules;
    }
}
