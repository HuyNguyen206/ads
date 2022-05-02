<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $ads = Advertisement::query()->take(8)->get();
        $rootCategories = Category::query()->rootParent()->with('advertisementsRoot', function ($builder) {
            $builder->latest()->take(8);
        })->get();
        return view('home', compact('rootCategories'));
    }
}
