<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdsStoreRequest;
use App\Http\Requests\AdsUpdateRequest;
use App\Models\Advertisement;
use App\Models\Category;
use App\Models\Country;
use App\Models\Fraud;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Validation\Rule;

class AdvertisementController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except('show', 'reportAds');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hasPublished = request()->has('published');
        $publishedTrue = request()->boolean('published');
        $ads = \request()->user()->ads()->when($hasPublished && $publishedTrue,function (Builder $builder) {
            $builder->where('is_published', true);
        })->when($hasPublished && !$publishedTrue,function (Builder $builder) {
            $builder->where('is_published', false);
        })->paginate(5);
        return view('ads.index', compact('ads'));
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
                $ads->addMediaFromRequest('feature_image')->toMediaCollection('ads.feature_image');
            }
            if ($request->hasFile('first_image')) {
                $ads->addMediaFromRequest('first_image')->toMediaCollection('ads.first_image');
            }
            if ($request->hasFile('second_image')) {
                $ads->addMediaFromRequest('second_image')->toMediaCollection('ads.second_image');
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
    public function edit(Advertisement $advertisement)
    {
        $this->authorize('edit-ads', $advertisement);
        $rootCategories = Category::query()->rootParent()->get();
        $countries = Country::all();
        return view('ads.edit', compact('advertisement', 'rootCategories', 'countries'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdsUpdateRequest $request, Advertisement $advertisement)
    {
        $updatedData = Arr::except($request->validated(), ['feature_image', 'first_image', 'second_image']);
        $advertisement->update($updatedData);
        if ($request->hasFile('feature_image')) {
            $advertisement->clearMediaCollection('ads.feature_image');
            $advertisement->addMediaFromRequest('feature_image')
                ->toMediaCollection('ads.feature_image');
        }
        if ($request->hasFile('first_image')) {
            $advertisement->clearMediaCollection('ads.first_image');
            $advertisement->addMediaFromRequest('first_image')
                ->toMediaCollection('ads.first_image');
        }
        if ($request->hasFile('second_image')) {
            $advertisement->clearMediaCollection('ads.second_image');
            $advertisement->addMediaFromRequest('second_image')
                ->toMediaCollection('ads.second_image');
        }
        return redirect()->route('ads.index')->with('success', 'The ads was update successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Advertisement $advertisement)
    {
        $advertisement->delete();
        $advertisement->clearMediaCollection('ads');
        return redirect()->route('ads.index')->with('success', 'Delete ads success');
    }

    public function viewAdsByUserEmail(User $user)
    {
        $ads = $user->ads()->when(\request()->has('published'),function (Builder $builder) {
            $builder->where('is_published', true);
        })->paginate(5);
        return view('ads.individual', compact('ads', 'user'));
    }

    public function getAdsSaved()
    {
        $ads = \request()->user()->savedAdvertisements()->paginate(5);
        return view('ads.ads-saved', compact('ads'));
    }

    public function deleteSavedAd($adId)
    {
        \request()->user()->savedAdvertisements()->detach($adId);
        return back()->with('success', 'This ad was removed successfully');
    }

    public function reportAds()
    {
        $user = auth()->user();
        $validatedData = \request()->validate([
            'ad_id' => ['required', Rule::exists('advertisements', 'id')],
           'reason' => ['required'],
           'email' => ['email', Rule::requiredIf(fn() => !isset($user))],
            'message' => ''
        ]);
        $validatedData['email'] = $user ? $user->email : $validatedData['email'];
        Fraud::create($validatedData);
        return back()->with('success', 'This ad was report successfully');
    }
}
