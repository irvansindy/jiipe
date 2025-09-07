<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NewsAndArticleController extends Controller
{
    public function index()
    {
        return view('layouts.admin.news_blog.index');
    }
}
