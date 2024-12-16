<?php

namespace App\Http\Requests\Dashboard\Pages;

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
           'content'     => 'required',
        ];
        if(request()->has("image")) {
            $rules["image"] = "required|image|max:10240";
        }
        return $rules;
    }
}
