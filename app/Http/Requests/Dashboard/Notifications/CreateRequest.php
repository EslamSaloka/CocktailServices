<?php

namespace App\Http\Requests\Dashboard\Notifications;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
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
           'users'               => 'required',
           'title'               => 'required|string|max:150',
           'message'             => 'required',
        ];
        return $rules;
    }
}
