<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Models\Category;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getCategoryById(Category $category)
    {
        return CategoryResource::collection($category->categories()->get(['id', 'name']));
    }
}
