<?php

namespace App\Http\Requests\Dashboard\Counters;

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
           'name'    => 'required|string|max:150',
           'count'   => 'required|numeric',
        ];
        return $rules;
    }
}
