<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Http\Requests\SubCategoryStoreRequest;
use App\Http\Requests\SubCategoryUpdateRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::query()->subCategories()->with('parent')->latest()->paginate(10);
        return view('backend.sub-categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rootCategories = Category::all();
        return view('backend.sub-categories.create', compact('rootCategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubCategoryStoreRequest $request)
    {
        $category = Category::create($request->only(['name', 'parent_id']));
        if ($request->hasFile('image')) {
            $category->addMediaFromRequest('image')->toMediaCollection('category');
        }
        return redirect()->route('categories.index')->with('success', 'Category was created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $categories = Category::all();
        return view('backend.sub-categories.edit', compact('category', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SubCategoryUpdateRequest $request, Category $category)
    {
        $category->update([
            'name' => $request->name,
            'parent_id' => $request->parent_id
        ]);
        if ($request->hasFile('image')) {
            $category->clearMediaCollection('category');
            $category->addMediaFromRequest('image')
                ->toMediaCollection('category');
        }
        return redirect()->route('sub-categories.index')->with('success', 'The sub category was update successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if ( $category->delete()) {
            $category->clearMediaCollection('category');
        }
        return back()->with('success', 'Delete successfully!');
    }
}
