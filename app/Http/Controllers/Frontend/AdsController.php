<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use Cohensive\Embed\Facades\Embed;
use Illuminate\Http\Request;

class AdsController extends Controller
{
    public function show(Advertisement $ad)
    {
        $ad->load('seller');
        return view('product.show', compact('ad'));
    }
}
