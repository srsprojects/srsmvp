<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RecyclablePriceRequest extends FormRequest
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
            'role' => 'required|in:depositor,agent,rider,collection-hub',
            'recyclableType' => 'required|integer|exists:recyclable_types,id',
            'price_per_kg' => 'required|numeric|between:-99999999999.99,99999999999.99',
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
