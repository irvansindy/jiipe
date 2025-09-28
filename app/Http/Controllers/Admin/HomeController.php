<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $locales = config('laravellocalization.supportedLocales');
        return view('layouts.admin.home.index', compact('locales'));
    }
    public function storeHeader(Request $request)
    {
        
    }
    public function storeSlider(Request $request)
    {

    }
}
