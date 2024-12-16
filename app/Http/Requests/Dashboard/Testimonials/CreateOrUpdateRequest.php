<?php

namespace App\Http\Requests\Dashboard\Testimonials;

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
           'name'       => 'required|string|max:150',
           'avatar'      => (isset($this->testimonial)) ? 'sometimes|image' : 'required|image',
           'message'    => 'required|string',
        ];
        return $rules;
    }
}
