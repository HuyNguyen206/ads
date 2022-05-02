<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $rootCategories = Category::query()->rootParent()->with('advertisementsRoot', function ($builder) {
            $builder->latest()->take(8);
        })->get();
        return view('home', compact('rootCategories'));
    }
}
