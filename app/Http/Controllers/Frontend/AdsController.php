<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Advertisement;

class AdsController extends Controller
{
    public function show(Advertisement $ad)
    {
        $ad->load('seller');
        return view('product.show', compact('ad'));
    }
}
