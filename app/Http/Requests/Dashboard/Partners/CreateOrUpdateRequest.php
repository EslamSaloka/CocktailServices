<?php

namespace App\Http\Requests\Dashboard\Partners;

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
           'logo'    => (isset($this->partner)) ? 'sometimes|image' : 'required|image',
        ];
        return $rules;
    }
}
