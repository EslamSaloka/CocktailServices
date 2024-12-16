<?php

namespace App\Http\Requests\Dashboard\Auth;

use Illuminate\Foundation\Http\FormRequest;

class ForgetPasswordRequest extends FormRequest
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
    public function rules()
    {
        return [
            'phone'      => 'required|numeric|digits:10|regex:/(05)[0-9]{8}/',
        ];
    }

    public function messages() {
        return [
            'phone.required'   => __('برجاء إدخال رقم الجوال'),
            'phone.numeric'    => __('يجب ان يكون الجوال رقما'),
            'phone.digits'     => __('برجاء إدخال 10 ارقام'),
            'phone.regex'      => __('صيغه الجوال غير صحيحة'),
        ];
    }
}
