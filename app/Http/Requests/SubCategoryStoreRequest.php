<?php

namespace App\Http\Requests;


class SubCategoryStoreRequest extends CategoryStoreRequest
{
    public function rules()
    {
        return parent::rules() + [
                'parent_id' => 'required|integer|exists:categories,id'
            ];
    }
}
