<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use function view;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['verified']);
    }

    public function index()
    {
        return view('backend.admin.index');
    }
}
