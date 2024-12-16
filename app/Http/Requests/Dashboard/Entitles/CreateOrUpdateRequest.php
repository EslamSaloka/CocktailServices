<?php

namespace App\Http\Requests\Dashboard\Entitles;

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
        $rules['name']         = 'required|string|max:150';
        $rules['services']     = 'required|array';
        $rules['services.*']     = 'required|exists:services,id';
        if(isset($this->entitle)) {
            $rules["whatsapp"] = [
                "required",
                "numeric",
                "unique:entities,whatsapp,".$this->entitle->id.',id',
            ];
        } else {
            $rules["whatsapp"] = "required|unique:entities,whatsapp|numeric";
        }
        return $rules;
    }
}
