<?php

namespace App\Http\Requests\Dashboard\Sliders;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            //
        ];
        if(request()->has("image")) {
            $rules["image"] = "required|image|max:10240";
        }
        return $rules;
    }
}
