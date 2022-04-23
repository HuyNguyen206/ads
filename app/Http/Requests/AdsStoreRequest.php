<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdsStoreRequest extends FormRequest
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
            'feature_image' => 'required|image',
            'first_image' => 'required|image',
            'second_image' => 'required|image',
            'name' => 'required|min:3|max:60',
            'description' => 'required|min:3|max:500',
            'price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'price_status' => 'required',
            'category_id' =>  'required',
            'product_condition' =>  'required',
            'country_id' =>  'required',
            'phone_number' =>  'numeric|min:8|max:13',
        ];
    }
}
