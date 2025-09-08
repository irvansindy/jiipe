<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AboutUsHeader;
use App\Models\AboutUsHeaderTranslation;
use App\Models\AboutUsContent;
use App\Models\AboutUsContentTranslation;
use App\Models\AboutUsVisionMision;
use App\Models\AboutUsVisionMisionTranslation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
class AboutUsController extends Controller
{
    public function index()
    {
        return view('layouts.admin.about_us.index');
    }
    public function storeHeader(Request $request)
    {
        $rules = [
            'cover_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ];
        foreach (config('laravellocalization.supportedLocales') as $locale => $properties) {
            $rules['cover_title_' . $locale] = 'required|string|max:255';
        }
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {
            $header = AboutUsHeader::first();
            if (!$header) {
                $header = new AboutUsHeader();
            }
            if ($request->hasFile('cover_image')) {
                if ($header->cover_image) {
                    Storage::disk('public')->delete($header->cover_image);
                }
                $header->cover_image = $request->file('cover_image')->store('about_us/cover', 'public');
            }
            $header->save();

            foreach (config('laravellocalization.supportedLocales') as $locale => $properties) {
                $translation = AboutUsHeaderTranslation::firstOrNew([
                    'about_us_header_id' => $header->id,
                    'locale' => $locale,
                ]);
                $translation->cover_title = $request->input('cover_title_' . $locale);
                $translation->save();
            }
            DB::commit();
            return redirect()->back()->with('success', 'Cover berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Cover gagal disimpan: ' . $e->getMessage());
        }
    }

    public function storeContent(Request $request)
    {
        $rules = [];
        foreach (config('laravellocalization.supportedLocales') as $locale => $properties) {
            $rules['content_title_' . $locale] = 'required|string|max:255';
            $rules['content_subtitle_' . $locale] = 'required|string|max:255';
            $rules['content_body_' . $locale] = 'required|string';
        }
        $rules['content_image'] = 'required|image|mimes:jpeg,png,jpg|max:2048';
        $rules['content_video_url'] = 'required|string|max:255';
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {
            $content = AboutUsContent::first();
            if (!$content) {
                $content = new AboutUsContent();
            }
            foreach (config('laravellocalization.supportedLocales') as $locale => $properties) {
                $translation = AboutUsContentTranslation::firstOrNew([
                    'about_us_content_id' => $content->id,
                    'locale' => $locale,
                ]);
                $translation->content_title = $request->input('content_title_' . $locale);
                $translation->content_subtitle = $request->input('content_subtitle_' . $locale);
                $translation->content_body = $request->input('content_body_' . $locale);
                if ($request->hasFile('content_image_' . $locale)) {
                    if ($translation->content_image) {
                        Storage::disk('public')->delete($translation->content_image);
                    }
                    $translation->content_image = $request->file('content_image_' . $locale)->store('about_us/content', 'public');
                }
                $translation->content_video_url = $request->input('content_video_url_' . $locale);
                $translation->save();
            }
            $content->save();
            DB::commit();
            return redirect()->back()->with('success', 'Content berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Content gagal disimpan: ' . $e->getMessage());
        }
    }

    public function storeVisionMission(Request $request)
    {
        dd($request->vision);
        $rules = [];
        foreach (config('laravellocalization.supportedLocales') as $locale => $properties) {
            $rules['title.' . $locale] = 'required|string|max:255';
            $rules['vision.' . $locale] = 'required|string';
            $rules['mission.' . $locale] = 'required|string';
        }
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {
            $visionMission = AboutUsVisionMision::first();
            if (!$visionMission) {
                $visionMission = new AboutUsVisionMision();
            }
            $visionMission->save();

            foreach (config('laravellocalization.supportedLocales') as $locale => $properties) {
                $translation = AboutUsVisionMisionTranslation::firstOrNew([
                    'about_us_vision_mission_id' => $visionMission->id,
                    'locale' => $locale,
                ]);
                $translation->title = $request->input('title')[$locale] ?? null;
                $translation->vision = $request->input('vision')[$locale] ?? null;
                $translation->mission = $request->input('mission')[$locale] ?? null;
                $translation->save();
            }
            DB::commit();
            return redirect()->back()->with('success', 'Visi Misi berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Visi Misi gagal disimpan: ' . $e->getMessage());
        }
    }
}
