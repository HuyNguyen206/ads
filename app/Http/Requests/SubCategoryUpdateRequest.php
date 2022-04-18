<?php

namespace App\Http\Requests;


class SubCategoryUpdateRequest extends CategoryUpdateRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return parent::rules() + [
                'parent_id' => 'required|integer|exists:categories,id'
        ];
    }
}
