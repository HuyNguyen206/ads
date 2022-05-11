<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use App\Models\Fraud;
use Illuminate\Http\Request;

class AdvertisementController extends Controller
{
    public function index()
    {
        $ads = Advertisement::latest()->with('seller')->paginate(5);
        return view('backend.ads.index', compact('ads'));
    }

    public function getFraudAds()
    {
        $ads = Fraud::with('advertisement')->paginate(5);
        return view('backend.ads.fraud-ads', compact('ads'));
    }

    public function delete(Fraud $fraud)
    {
        $fraud->delete();
        return back()->with('success', 'Delete success');
    }
}
