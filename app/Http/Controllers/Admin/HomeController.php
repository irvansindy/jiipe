<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct() {
        $this->locale = config('laravellocalization.supportedLocales');
    }
    public function index()
    {
        $locales = $this->locale;
        return view('layouts.admin.home.index', compact('locales'));
    }
}
