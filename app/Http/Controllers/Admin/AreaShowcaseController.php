<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AreaShowCase;
use Illuminate\Support\Facades\Storage;
class AreaShowcaseController extends Controller
{
    public function __construct() {
        $this->locale = config('laravellocalization.supportedLocales');
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'is_active' => 'boolean',
            'position' => 'nullable|integer',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('area_showcases', 'uploads');
        }

        AreaShowcase::create($data);
        // return redirect()->route('area-showcase.index')->with('success', 'Area Showcase created.');
    }

}
