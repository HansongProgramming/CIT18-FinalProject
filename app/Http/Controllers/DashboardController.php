<?php

namespace App\Http\Controllers;

use App\Models\Asset;

class DashboardController extends Controller
{
    public function index()
    {
        $assets = Asset::with('user')->latest()->get();
        return view('dashboard', compact('assets'));
    }
}
