<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function getAdsByChildCategory(Category $subCategory, Category $category)
    {
        $ads = $category->getAds();
        return $this->renderViewWithCategoryData($ads, $subCategory);
    }

    public function getAdsBySubCategory(Category $rootCategory, Category $category)
    {
        $ads = $category->getAds('sub_category_id');
        return $this->renderViewWithCategoryData($ads, $category);
    }

    public function getAdsByRootCategory(Category $rootCategory)
    {
        $ads = $rootCategory->getAds('category_id');
        return $this->renderViewWithCategoryData($ads, $rootCategory);
    }

    private function renderViewWithCategoryData($ads, $category)
    {
        $subCategories = $category->categories()->with('parent')->get();
        return view('product.subcategory', compact('ads', 'subCategories'));
    }
}
