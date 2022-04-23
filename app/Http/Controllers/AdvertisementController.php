<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdsStoreRequest;
use App\Models\Advertisement;
use App\Models\Category;
use App\Models\Country;
use Illuminate\Http\Request;

class AdvertisementController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except('index', 'show');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rootCategories = Category::query()->rootParent()->get();
        $countries = Country::all();
        return view('ads.create', compact('rootCategories', 'countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdsStoreRequest $request)
    {
        $ads = $request->user()->ads()->create(array_merge($request->except(['feature_image', 'first_image', 'second_image', '_token'])));
        if ($ads) {
            if ($request->hasFile('feature_image')) {
                $ads->addMediaFromRequest('feature_image')->toMediaCollection('ads');
            }
            if ($request->hasFile('first_image')) {
                $ads->addMediaFromRequest('first_image')->toMediaCollection('ads');
            }
            if ($request->hasFile('second_image')) {
                $ads->addMediaFromRequest('second_image')->toMediaCollection('ads');
            }
        }
        return redirect()->route('ads.index')->with('success', 'The ads was created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
