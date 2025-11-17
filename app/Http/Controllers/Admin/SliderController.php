<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\HomeSlider;
use App\Models\HomeSliderTranslation;
use Illuminate\Support\Str;
use App\Helpers\FormatResponseJson;
use Illuminate\Support\Facades\DB;
class SliderController extends Controller
{
    public function fetch()
    {
        $locale = app()->getLocale();
        $sliders = HomeSlider::with(['translations' => fn($q) => $q->where('locale', $locale)])->get();
        return FormatResponseJson::success($sliders, 'Fetched Slider Successfully');
    }
    public function fetchById(Request $request)
    {
        try {
            // dd($request->id);
            $sliders = HomeSlider::with('translations')
            ->where('id', $request->id)->first();
            return FormatResponseJson::success($sliders,'Fetched Slider Successfully');
        } catch (\Throwable $th) {
            return FormatResponseJson::error(null,$th->getMessage(), 400);
        }
    }
    public function save(Request $request, $id = null)
    {
        try {
            $locales = config('laravellocalization.supportedLocales');

            $rules = [
                // file inputs (either image or video can be provided)
                'slider_file' => 'nullable|mimetypes:image/jpeg,image/png,image/webp,video/mp4,video/ogg,video/webm|max:2048',

                // translations arrays + per-locale required
                'title' => 'required|array',
                'description' => 'required|array',
                'title.*' => 'required|string|max:255',
                'description.*' => 'required|string',
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return FormatResponseJson::error($validator->errors(),'Validation failed', 422);
            }

            DB::beginTransaction();

            // find existing slider if updating
            $slider = $request->id ? HomeSlider::find($request->id) : null;
            // handle uploaded file(s) and map to single 'file' column
            $filePath = null;
            if ($request->hasFile('slider_file')) {
                if ($slider && $slider->file) {
                    $old = public_path(ltrim($slider->file, '/'));
                    if (file_exists($old)) @unlink($old);
                }
                $slider_file = $request->file('slider_file');
                $slider_fileName = Str::random(12) . '_' . time() . '.' . $slider_file->getClientOriginalExtension();
                $dest = public_path('asset/carousel-slider-video');
                if (!is_dir($dest)) mkdir($dest, 0755, true);
                $slider_file->move($dest, $slider_fileName);
                $filePath = '/asset/carousel-slider-video/' . $slider_fileName;
            } else {
                // no uploaded file; when creating, file column will be null; when updating, keep existing
                $filePath = $slider ? $slider->file : null;
            }

            $mainData = [
                'file' => $filePath,
            ];

            if ($slider) {
                // update existing using updateOrCreate (match by id)
                $slider = HomeSlider::updateOrCreate(['id' => $request->id], $mainData + $slider->toArray());
                $slider->fill($mainData);
                $slider->save();
            } else {
                // create new
                $slider = HomeSlider::create($mainData);
            }

            // translations: ensure each locale saved (required)
            foreach ($locales as $locale => $props) {
                HomeSliderTranslation::updateOrCreate(
                    [
                        'home_sliders' => $slider->id,
                        'locale' => $locale,
                    ],
                    [
                        'title' => $request->input("title.{$locale}"),
                        'description' => $request->input("description.{$locale}"),
                        'is_active' => $request->input("is_active.{$locale}", 0) ? 1 : 0,
                    ]
                );
            }

            DB::commit();

            $message = $id ? 'Slider updated successfully.' : 'Slider created successfully.';
            return FormatResponseJson::success(['id' => $slider->id], $message);
        } catch (\Throwable $th) {
            DB::rollBack();
            return FormatResponseJson::error(null, $th->getMessage(), 500);
        }
    }

    // route targets
    public function store(Request $request)
    {
        return $this->save($request, null);
    }

    public function update(Request $request)
    {
        return $this->save($request);
    }
}
