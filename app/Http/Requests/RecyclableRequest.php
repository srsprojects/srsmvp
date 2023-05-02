<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RecyclableRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // only allow updates if the user is logged in
        return backpack_auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user' => 'required|integer|exists:users,id',
            'recyclableType' => 'required|integer|exists:recyclable_types,id',
            'qty' => 'required|numeric|between:-9999999.999,9999999.999',
            'earnings' => 'required|numeric|between:-99999999999.99,99999999999.99',
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            //
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            //
        ];
    }
}
