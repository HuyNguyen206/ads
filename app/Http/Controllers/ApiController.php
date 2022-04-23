<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Http\Resources\CityResource;
use App\Http\Resources\CountryResource;
use App\Http\Resources\StateResource;
use App\Models\Category;
use App\Models\Country;
use App\Models\State;

class ApiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getCategoryById(Category $category)
    {
        return response()->success(CategoryResource::collection($category->categories()->get(['id', 'name'])));
    }

    public function getStatesByCountryId(Country $country)
    {
        return response()->success(StateResource::collection($country->states()->get(['id', 'name'])));
    }

    public function getCitiesByStateId(State $state)
    {
        return response()->success(CityResource::collection($state->cities()->get(['id', 'name'])));
    }
}
