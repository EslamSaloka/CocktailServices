<?php

namespace App\Http\Requests\Main\Services;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class StoreNewOrderRequest extends FormRequest
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
            'bank_id'           => 'required|exists:banks,id',
            'bank_name'         => 'required',
            'account_name'      => 'required',
            'person_any'        => 'sometimes',
            'transfer_date'     => 'required',
            'transfer_number'   => 'required',
            'transfer_image'    => 'required|image',
            'transfer_price'    => 'required|numeric',
        ];

        return $rules;
    }
}
